<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', [TestController::class, 'index'])->name('index');
Route::post('/calculate', [TestController::class, 'calculate'])->name('calculate');
