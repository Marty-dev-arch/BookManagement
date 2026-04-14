<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'published_year',
        'isbn',
        'pages',
        'language',
        'publisher',
        'price',
        'is_available',
        'cover_image',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'published_year' => 'integer',
        'pages' => 'integer',
    ];
}

