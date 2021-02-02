<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Str;
use Illuminate\Support\Collection;

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

    public function result(Request $request, Quiz $quiz){

        $data = $request->except('_token');

        $quiz->load('questions.answers');

        $score=0;
        
        foreach ($quiz->questions as $key => $question) {
            if(array_key_exists($question->id, $data) && $data[$question->id]!==null){
                if($data[$question->id] == $question->answers->where('type', 'correct')->first()->id){
                    $score+=1;
                }
                $question->users()->attach(auth()->id(), ['answer' => $data[$question->id]]);
            }else{
                $question->users()->attach(auth()->id(), ['answer' => null]);
            }
        }

        $correctAnswersCount=$score;
        $score = round($score/count($quiz->questions)*100);

        $quiz->users()->attach(auth()->id(),[
            'score'=>$score,
            'correct_answers_count' => $correctAnswersCount,
            'wrong_answers_count' => count($quiz->questions) - $correctAnswersCount,
        ]);

        return redirect()->route('quizzes.details',['slug'=>$quiz->slug])->withSuccess('Quiz uğurla tamamlandı! Topladığınız bal: '.$score);
    }
}
