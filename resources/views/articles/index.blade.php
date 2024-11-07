<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
    <style>
    .custom-button {
        background-color: #007BFF;
        color: #FFFFFF;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .custom-button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class="container">
    <h1>Liste des Articles - Bienvenue, {{ auth()->user()->name }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('articles.refresh') }}" class="custom-button">Actualiser les Articles</a>
        <a href="{{ route('dashboard') }}" class="custom-button">Profile</a>
        <ul>
            @foreach($articles as $article)
                <li>
                    <strong>{{ $article->title }}</strong> par {{ $article->author }}<br>
                    <em>Source:</em> {{ $article->source->name }}<br>
                    <em>Catégorie:</em> {{ $article->category->name }}<br>
                    <em>Date : </em> {{ $article->publication_date }}<br>
                    <p>{{ $article->content }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
