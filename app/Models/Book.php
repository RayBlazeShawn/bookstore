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
        'publication_date',
        'isbn',
        'genre',
        'description',
        'image',
        'publisher'
    ];


    protected $casts = [
        'publication_date' => 'date',
    ];

}
