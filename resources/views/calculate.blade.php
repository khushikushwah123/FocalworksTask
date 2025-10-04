<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3>Result</h3>
        <p>Maximum Possible Score: {{ $result['max_score'] }}</p>
        <p>Points Scored: {{ $result['points_scored'] }}</p>
        <p>Percentage: {{ $result['percentage'] }}%</p>

        <a href="{{ route('index') }}" class="btn btn-primary">Back</a>
    </div>
</body>
</html>
