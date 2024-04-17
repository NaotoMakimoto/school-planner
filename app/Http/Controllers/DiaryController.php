<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Diary;

class DiaryController extends Controller
{
    function store(Request $request) 
    {
        $diary = new Diary;
        $diary -> date = Carbon::today();
        $diary -> mood = $request -> mood;
        $diary -> content = $request -> content;
        $diary -> comment = $request -> comment;

        $diary -> save();

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
