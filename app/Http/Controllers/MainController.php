<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Str;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes=Quiz::where('status','active')
                    ->withCount('questions')
                    ->orderBy('updated_at','desc')
                    ->paginate(1);

        return view('dashboard',['quizzes'=>$quizzes]);
    }

    public function show($slug){
        $quiz=Quiz::whereSlug($slug)->withCount('questions')->first() ?? abort(404);

        return view('quiz',['quiz'=>$quiz]);
    }
}
