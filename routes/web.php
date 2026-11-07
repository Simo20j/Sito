<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/registrazione', [RegisterController::class, 'create'])->name('register');
    Route::post('/registrazione', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/articoli/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/console', [ConsoleController::class, 'index'])->name('consoles.index');
    Route::get('/videogiochi', [GameController::class, 'index'])->name('games.index');
    Route::get('/recensioni', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/recensioni', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
