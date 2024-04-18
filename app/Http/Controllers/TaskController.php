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
        $today = Carbon::today(); 
        $date = $request->input('date');
    
        // firstOrCreateメソッドで、データがあれば取得、なければ新しいレコードを作成して保存
        $task = Task::firstOrCreate(['date' => $date]);
    
        $lessons = Lesson::with('subject')
            ->whereDate('date', $date)
            ->orderBy('period', 'asc')
            ->get();
    
        $diary = Diary::where('date', $date)->first(); 
    
        return view('home', compact('task', 'date', 'today', 'lessons', 'diary'));
    }
    


    function update(Request $request, $id)
    {
        $today = Carbon::today(); 

        $task = Task::find($id);
        $task -> assignments = $request -> assignments;
        $task -> belongings = $request -> belongings;
        $date = $task -> date;

        $task -> save();

        $lessons = Lesson::with('subject')
            ->whereDate('date', $date)
            ->orderBy('period', 'asc')
            ->get();
    
        $diary = Diary::where('date', $date)->first(); 
        

        return view('home', compact('task', 'date', 'today', 'lessons', 'diary'));
    }
}
