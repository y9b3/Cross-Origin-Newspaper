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
            margin-right: 10px;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        .filter-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Articles - Bienvenue, {{ auth()->user()->name }}</h1>

        <!-- Message de success si les articles sont actualiser -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('articles.refresh') }}" class="custom-button">Actualiser les Articles</a>
        <a href="{{ route('dashboard') }}" class="custom-button">Profile</a>
        <form action="{{ route('articles.index') }}" method="GET" class="filter-form">
            <label for="category">Catégorie:</label>
            <select name="category" id="category">
                <option value="">Toutes</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="date">Date de publication:</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">

            <button type="submit" class="custom-button">Filtrer</button>
        </form>

        <!-- Liste des articles -->
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
