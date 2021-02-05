<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes=Quiz::where('status','active')
                    ->where(function($query){
                        $query->whereNull('finished_at')->orWhere('finished_at','>',now());
                    })
                    ->withCount('questions')
                    ->orderBy('updated_at','desc')
                    ->paginate(6);

        $user = Auth::user()->load(['quizzes'=>function($query){
            $query->orderByDesc('created_at')->take(10);
        }]);
        // return $userResults;
        return view('dashboard',['quizzes'=>$quizzes, 'user'=>$user]);
    }

    public function details($slug){
        $quiz=Quiz::whereSlug($slug)
                ->with(['topTenUsers'])
                ->withCount(['questions'])
                ->where('status','active')
                ->first() ?? abort(404);

        return view('quizzes.details',['quiz'=>$quiz]);
    }

    public function show($slug){

        $quiz=Quiz::where('slug',$slug)
            ->where('status','active')
            ->with(['questions'])
            ->first()??abort(404);

        if($quiz->current_user){
            // return $quiz;
            return view('quizzes.results', ['quiz'=>$quiz]);
        }

        return view('quizzes.show',['quiz'=>$quiz]);
    }

    public function result(Request $request, Quiz $quiz){

        if($quiz->current_user!=null){
            abort(403, 'Bu quizə daha öncə qatılmısınız!');
        }

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
