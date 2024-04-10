<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
{
    $today = Carbon::today(); // 今日の日付を取得

    // 今日の日付に該当するタスクを取得
    $tasks = Task::whereDate('date', $today)->get();

    // ビューにデータを渡す
    return view('home', ['tasks' => $tasks, 'today' => $today->toDateString()]);
}
}
