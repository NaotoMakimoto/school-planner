<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;


class LessonController extends Controller
{
    function store(Request $request)
    {
        $selected_date = $request->session()->get('selected_date', Carbon::today()->toDateString());

        $lesson = Lesson::updateOrCreate(
            [
                'date' => $selected_date,
                'period' => $request -> period,
                
            ],
            [
                'subject_id' => $request->subject_id,
                'content' => $request->content
            ]
        );

        return redirect()->route('home');
    }

}
