<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentResponse;

class ResponseController extends Controller
{
    function store(Request $request)
    {
        $response = new StudentResponse;
        $response -> lesson_id = $request -> lesson_id;
        $response -> understanding = $request -> understanding;
        $response -> comment = $request -> comment;

        $response -> save();

        return redirect() -> route('home');
    }
}