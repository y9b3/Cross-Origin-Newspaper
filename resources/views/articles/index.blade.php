<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Inclure le CSS de base si nécessaire -->
</head>
<body>
    <div class="container">
        <h1>Liste des Articles</h1>
        <ul>
            @foreach($articles as $article)
                <li>
                    <strong>{{ $article->title }}</strong> par {{ $article->author }}<br>
                    <em>Source:</em> {{ $article->source->name }}<br>
                    <em>Catégorie:</em> {{ $article->category->name }}<br>
                    <p>{{ $article->content }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
