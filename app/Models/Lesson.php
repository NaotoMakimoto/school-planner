<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    function studentResponse()
    {
        return $this->hasOne('App\Models\StudentResponse');
    }
}
