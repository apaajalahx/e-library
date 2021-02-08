<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = "level";

    protected $fillable = [
        "users_id", "level_name"
    ];
}
