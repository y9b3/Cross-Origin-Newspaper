<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    
    public function index()
    {
        $articles = Article::with(['source', 'category'])->get();
        return view('articles.index', compact('articles'));
    }

    
    public function getJson()
    {
        $articles = Article::with(['source', 'category'])->get();
        return response()->json($articles);
    }
}