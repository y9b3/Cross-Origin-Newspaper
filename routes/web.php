<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home'); // Utilise la vue home.blade.php
});

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/json', [ArticleController::class, 'getJson']);