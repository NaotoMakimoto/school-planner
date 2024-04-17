<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    function store(Request $request)
    {
        $lesson = new Lesson;
        $lesson -> date = Carbon::today();
        $lesson -> period = $request -> period;
        $lesson -> subject_id = $request -> subject_id;
        $lesson -> content = $request -> content;

        $lesson -> save();

        return redirect()->route('home');
    }
}