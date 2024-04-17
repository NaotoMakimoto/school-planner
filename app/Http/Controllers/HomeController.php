<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lesson;
// use App\Models\StudentResponse;
use App\Models\Diary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $today = Carbon::today(); 
        $tasks = Task::whereDate('date', $today)->get();    
        $lessons = Lesson::with('subject', 'studentResponse')
            ->whereDate('date', $today)
            ->orderBy('period', 'asc') // 'period'を基準に昇順でソート
            ->get();
        $diary = Diary::with('teacherComment')
            ->where('date', $today)->first(); 
        return view('home', ['lessons' => $lessons, 'tasks' => $tasks, 'diary' => $diary, 'today' => $today->toDateString()]);
    }
}
