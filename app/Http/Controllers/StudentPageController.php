<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class StudentPageController extends Controller
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

    public function show($sid)
    {   
        
        $teacherId = Auth::id();

        Auth::loginUsingId($sid);  // ユーザーIDに基づいてログイン
        session(['teacherId' => $teacherId]);
        return redirect('/home');
    }

    public function back()
    {   
        $teacherId = session('teacherId');

        Auth::loginUsingId($teacherId);  // ユーザーIDに基づいてログイン
        session()->forget('teacherId');
        return redirect('/home');  
    }
    
}
