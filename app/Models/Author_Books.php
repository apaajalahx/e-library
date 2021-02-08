<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Author_Books extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "author_books";

    protected $fillable = [
        "books_id", "author_id"
    ];
}
