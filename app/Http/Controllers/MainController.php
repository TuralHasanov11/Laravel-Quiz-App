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
                    ->paginate(6);

        return view('dashboard',['quizzes'=>$quizzes]);
    }

    public function details($slug){
        $quiz=Quiz::whereSlug($slug)
                ->withCount('questions')
                ->where('status','active')
                ->first() ?? abort(404);

        return view('quizzes.details',['quiz'=>$quiz]);
    }

    public function show($slug){

        $quiz=Quiz::where('slug',$slug)
            ->where('status','active')
            ->with('questions')
            ->first()??abort(404);


        return view('quizzes.show',['quiz'=>$quiz]);
    }
}
