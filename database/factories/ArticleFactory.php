<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, 
            'author' => $this->faker->name, 
            'publication_date' => $this->faker->date, 
            'content' => $this->faker->paragraph, 
            'source_id' => 1, 
            'category_id' => 1, 
        ];
    }
}
