<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model{
    use HasFactory;

    protected $filiable = [
        'title',
        'author',
        'publication_date',
        'content',
        'source_id',
        'category_id',
    ];

    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
}
