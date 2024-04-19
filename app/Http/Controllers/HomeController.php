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


    public function index(Request $request)
    {
        $today = Carbon::today(); 
        $selected_date = $request->session()->get('selected_date', Carbon::today()->toDateString());
        $date = $selected_date;
        $task = Task::whereDate('date', $date)->first();    
        $lessons = Lesson::with('subject')
            ->whereDate('date', $date)
            ->orderBy('period', 'asc') // 'period'を基準に昇順でソート
            ->get();
        $diary = Diary::where('date', $date)->first(); 
        return view('home', compact('task', 'date', 'today', 'lessons', 'diary'));
    }

    function check()
    {
        return view('calendar');
    }
}
