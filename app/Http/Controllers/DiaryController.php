<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;


class DiaryController extends Controller
{
    function store(Request $request) 
    {
        $selected_date = $request->session()->get('selected_date', Carbon::today()->toDateString());
        
        $questions = $request->input('questions', []);

        $userId = Auth::id();
        
        $diary = Diary::updateOrCreate(
            [
                'user_id' => $userId,
                'date' => $selected_date               
            ],
            [
                'mood' => $request->mood,
                'content' => $request->content,
                // 'questions' 配列から個々の値を取得し、存在しない場合は 0 を設定
                'question1' => isset($questions['question1']) ? 1 : 0,
                'question2' => isset($questions['question2']) ? 1 : 0,
                'question3' => isset($questions['question3']) ? 1 : 0,
            ]
        );
    
        return redirect()->route('home');
    }
    
    

    function update(Request $request, $id)
    {
        $diary = Diary::find($id);
        $diary -> comment = $request -> comment;
        $diary -> save();
        return redirect() -> route('home');
    }
}
