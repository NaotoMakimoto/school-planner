<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Diary;

class DiaryController extends Controller
{
    function store(Request $request) 
    {
        $selected_date = $request->session()->get('selected_date', Carbon::today()->toDateString());
        
        $diary = Diary::updateOrCreate(
            [
                'date' => $selected_date
            ],
            [
                'mood' => $request -> mood,
                'content' => $request -> content
            ]
        );

        return redirect() -> route('home');

    }

    function update(Request $request, $id)
    {
        $diary = Diary::find($id);
        $diary -> comment = $request -> comment;
        $diary -> save();
        return redirect() -> route('home');
    }
}
