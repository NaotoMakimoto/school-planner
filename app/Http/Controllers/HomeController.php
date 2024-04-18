<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lesson;
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
        $date = $today->format('Y-m-d');
        $task = Task::whereDate('date', $date)->first();    
        $lessons = Lesson::with('subject')
            ->whereDate('date', $date)
            ->orderBy('period', 'asc') // 'period'を基準に昇順でソート
            ->get();
        $diary = Diary::where('date', $date)->first(); 
        return view('home', compact('task', 'date', 'today', 'lessons', 'diary'));
    }
}
