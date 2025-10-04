<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'response' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        $result = $this->checkOnes($request->response, $request->correct_answer);

        return view('calculate', compact('result'));
    }

    protected function checkOnes($response, $correctAnswer)
    {
        $corrected = $this->check_request($correctAnswer);
        $responseed = $this->check_request($response);

        $percent = [];
        $score = [];

        foreach ($corrected as $token) {
            $n = $token['normalized'];
            $percent[$n] = ($percent[$n] ?? 0) + 1;

            if (!isset($score[$n])) {
                $score[$n] = $token['score'];
            }
        }

        $maxScore = array_sum(array_column($corrected, 'score'));

        $points = 0;
        foreach ($responseed as $token) {
            $n = $token['normalized'];
            if (isset($percent[$n]) && $percent[$n] > 0) {
                $points += $score[$n] ?? 0;
                $percent[$n]--;
            }
        }

        $percentage = $maxScore > 0 ? round(($points / $maxScore) * 100, 2) : 0;

        return [
            'max_score' => $maxScore,
            'points_scored' => $points,
            'percentage' => $percentage
        ];
    }

    protected function check_request($text)
    {
        preg_match_all('/[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*/', $text, $matches);
        $tokens = [];

        foreach ($matches[0] as $word) {
            $isNumber = preg_match('/^\d+$/', $word);
            $letters = preg_replace('/[^A-Za-z]/', '', $word);
            $len = strlen($letters);

            if ($isNumber) {
                $score = 4;
            } else {
                if ($len > 7) {
                    $score = 3;
                } elseif ($len < 5) {
                    $score = 0;
                } else {
                    $score = 1;
                }
            }

            $tokens[] = [
                'raw' => $word,
                'normalized' => strtolower($word),
                'score' => $score
            ];
        }

        return $tokens;
    }
}
