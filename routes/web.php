<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home'); 
    
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');;
Route::get('/articles/json', [ArticleController::class, 'getJson']);
Route::get('/lemonde/articles', [ArticleController::class, 'getLeMondeArticles']);
Route::get('/articles/refresh', [ArticleController::class, 'refreshArticles'])->name('articles.refresh');