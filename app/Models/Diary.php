<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $dates = ['date'];

    protected $fillable = [
        'date',
        'user_id',
        'mood',
        'question1',
        'question2',
        'question3',
        'content',
        'comment'
    ];
}
