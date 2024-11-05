<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Source;
use App\Models\Category;

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

    public function getLeMondeArticles()
{
    // Obtenir la date d'aujourd'hui pour la requête
    $date = now()->toDateString();
    $response = Http::get("https://api-catch-the-dev.microsoc.fr/lemonde?get={$date}");

    if ($response->successful()) {
        $articles = $response->json()['data'];

        foreach ($articles as $articleData) {
            
            $source = Source::firstOrCreate(['name' => 'Le Monde']);

            
            $category = Category::firstOrCreate(['name' => $articleData['category']]);

           
            $existingArticle = Article::where('title', $articleData['title'])->first();

            if (!$existingArticle) {
                Article::create([
                    'title' => $articleData['title'],
                    'author' => $articleData['author'],
                    'publication_date' => $articleData['published_at'],
                    'content' => $articleData['content'],
                    'source_id' => $source->id,
                    'category_id' => $category->id,
                ]);
            }
        }

        return response()->json(['message' => 'Articles saved successfully.']);
    } else {
        return response()->json(['error' => 'Failed to fetch articles'], 500);
    }
}

}  