<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    function teacherComment()
    {
        return $this->hasOne('App\Models\teacherComment');
    }
}
