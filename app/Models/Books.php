<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = "books";

    protected $fillable = [
        "title" , "description","pdf" 	
    ];
    public function author()
    {
        return $this->belongsToMany(
            Author::class,
            'author_books',
            'books_id',
            'author_id');
    }
}
