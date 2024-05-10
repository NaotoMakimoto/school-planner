<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\StudentLessonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');

Route::post('/studentLessons/{id}', [StudentLessonController::class, 'store'])->name('studentLessons.store');

Route::post('/diaries', [DiaryController::class, 'store'])->name('diaries.store');

Route::put('/diaries/{id}', [DiaryController::class, 'update'])->name('diaries.update');

Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::get('/calendar', [HomeController::class, 'check'])->name('calendar.check');

