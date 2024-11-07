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
        $articles = Article::orderBy('publication_date','desc')->get();
        return view('articles.index', compact('articles'));
    }

    public function refreshArticles(){
        $this->getLeMondeArticles();

        return redirect()->route('articles.index')->with('success','Les articles ont été actualisé.');
    }

    
    public function getJson()
    {
        $articles = Article::with(['source', 'category'])->get();
        return response()->json($articles);
    }

    public function getLeMondeArticles()
{
    
    $today = now()->toDateString();
    $response = Http::get("https://api-catch-the-dev.microsoc.fr/lemonde?date=".$today);

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
public function getLequipeArticles()
{
    
    $response = Http::get('https://api-catch-the-dev.microsoc.fr/lequipe', [
        'access_token' => 'vQS97b12DxqeAqs15CbvSQdmBP13'
    ]);

    if ($response->successful()) {
        $articles = $response->json()['data'];

        foreach ($articles as $articleData) {
            $source = Source::firstOrCreate(['name' => 'L\'Équipe']);
            $category = Category::firstOrCreate(['name' => $articleData['category']['name']]);
            $existingArticle = Article::where('title', $articleData['title'])->first();

            if (!$existingArticle) {
                Article::create([
                    'title' => $articleData['title'],
                    'author' => $articleData['author']['first_name'] . ' ' . $articleData['author']['last_name'],
                    'publication_date' => $articleData['created_at'],
                    'content' => $articleData['content'],
                    'source_id' => $source->id,
                    'category_id' => $category->id,
                ]);
            }
        }

        return response()->json(['message' => 'Articles de L\'Équipe enregistrés avec succès.']);
    } else {
        return response()->json(['error' => 'Dommage', 'details' => $response->body()], 500);
    }
}


}  