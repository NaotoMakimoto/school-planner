<?php

namespace App\Http\Controllers;

use App\Models\StudentLesson;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;


class StudentLessonController extends Controller
{
    function store(Request $request, int $id)
    {
        $userId = Auth::id();
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return redirect() -> back() -> with('error', '指定されたレッスンが見つかりません。');
        }
        $lessonId = $id;

        $studentLessons = new StudentLesson;

        $studentLessons -> user_id = $userId;
        $studentLessons -> lesson_id = $lessonId;
        $studentLessons -> understanding = $request -> understanding;
        $studentLessons -> comment = $request -> comment;
        $studentLessons -> save();

        return redirect()->route('home');
    }

    function show($id)
    {
        $studentLessons = StudentLesson::where('lesson_id', $id);
        $understandings = $studentLessons -> understanding;
    }
    
}
