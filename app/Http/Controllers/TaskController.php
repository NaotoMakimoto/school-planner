<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lesson;
use App\Models\Diary;

class TaskController extends Controller
{
    function store(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        // セッションに選択された日付を保存
        $request->session()->put('selected_date', $date);
    
        // firstOrCreateメソッドで、データがあれば取得、なければ新しいレコードを作成して保存
        $task = Task::firstOrCreate(['date' => $date]);
    
        return redirect()->route('home');
    }
    


    function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task -> assignments = $request -> assignments;
        $task -> belongings = $request -> belongings;
        $task -> announcements = $request -> announcements;

        $task -> save();

        $request->session()->put('selected_date', $task->date);

        return redirect()->route('home');
    }
}
