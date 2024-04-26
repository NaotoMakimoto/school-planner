<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $dates = ['date'];

    protected $fillable = [
        'date',
        'mood',
        'question1',
        'question2',
        'question3',
        'content',
        'comment'
    ];
}
