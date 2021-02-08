<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'author';

    protected $fillable = [
        'name'
    ];
    
    public function books()
    {
        return $this->belongsToMany(
            Books::class,
            'author_books',
            'books_id',
            'author_id');
    }
}
