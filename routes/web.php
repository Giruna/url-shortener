<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('shortener');
})->name('home');

// URL shortener
Route::post('/shorten', [UrlShortenerController::class, 'shorten'])
    ->name('shorten');

// Redirect endpoint
Route::get('/r/{code}', [UrlShortenerController::class, 'redirect'])
    ->name('redirect');
