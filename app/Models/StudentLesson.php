<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLesson extends Model
{
    use HasFactory;

    function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = [
        'user_id',
        'lesson_id',
        'understanding',
        'comment',
    ];
}
