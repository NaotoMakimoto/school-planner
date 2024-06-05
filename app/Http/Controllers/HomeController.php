<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lesson;
use App\Models\Diary;
use App\Models\StudentLesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        $user = Auth::user();
        $userId = Auth::id();
        $grade = $user->grade;
        $class = $user->class;
        $students = User::where('grade', $grade)
                        ->where('class', $class)
                        ->orderBy('attendance_number', 'asc')
                        ->get();
                        
        $today = Carbon::today(); 
        // クエリパラメータの 'date' を確認し、存在すればそれを使用
        $date = $request->query('date', $request->session()->get('selected_date', $today->toDateString()));

        $task = Task::whereDate('date', $date)->first();    
        $lessons = Lesson::with('subject')
            ->whereDate('date', $date)
            ->orderBy('period', 'asc') // 'period'を基準に昇順でソート
            ->get();
        $studentLessons = StudentLesson::where('user_id', $userId)
                            ->get();
        $diary = Diary::where('date', $date)
                        ->where('user_id', $userId)
                        ->first(); 

        return view('home', compact('task', 'date', 'today', 'lessons', 'studentLessons', 'diary', 'user','students'));
    }


    function check()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $diaries = Diary::where('user_id', $userId)->get();

        return view('calendar', compact('diaries', 'user'));
    }
}
