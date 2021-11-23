<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    //apenas os valores de title e content serão preechidos na tabela
    
    protected $fillable = ['title', 'content'];
}