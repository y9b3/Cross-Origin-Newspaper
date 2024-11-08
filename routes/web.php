<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');;
    Route::get('/articles/json', [ArticleController::class, 'getJson']);
    Route::get('/lemonde/articles', [ArticleController::class, 'getLeMondeArticles']);
    Route::get('/lequipe/articles', [ArticleController::class, 'getLequipeArticles']);
    Route::get('/articles/refresh', [ArticleController::class, 'refreshArticles'])->name('articles.refresh');
});

require __DIR__.'/auth.php';
