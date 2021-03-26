<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuestionCreateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{
   
    public function index(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('admin.questions.index', [
            'quiz'=>$quiz
        ]);
    }

   
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create',['quiz'=>$quiz]);
    }

    
    public function store(QuestionCreateRequest $request, Quiz $quiz)
    {
        $data = $request->all();
        
        if($request->has('image')){
            
            $lastId = $quiz->questions()->count()?($quiz->questions()->count()+1):1;
            $fileName=$lastId.'-'.Str::slug($data['question']).'.'.$request->image->extension();
            $fileDirectory = 'question-images/'.$quiz->id.'/'.$fileName;
            // $request->image->move(public_path('question-images/'.$quiz->id),$fileName);
        }else{
            $fileDirectory = null;
        }

        $question = new Question(['question'=>$data['question'], 'image'=>$fileDirectory]);
        $quiz->questions()->save($question);

        $question->answers()->createMany([
            ['answer'=>$data['answers'][1], 'type'=>$data['correct_answer']==1?'correct':'wrong'],
            ['answer'=>$data['answers'][2], 'type'=>$data['correct_answer']==2?'correct':'wrong'],
            ['answer'=>$data['answers'][3], 'type'=>$data['correct_answer']==3?'correct':'wrong'],
            ['answer'=>$data['answers'][4], 'type'=>$data['correct_answer']==4?'correct':'wrong']
        ]);

        return redirect()->route('admin.quizzes.questions.index',['quiz'=>$quiz])->withSuccess('Sual əlavə olundu!');
    }

    public function edit(Quiz $quiz,Question $question)
    {
        $question->load('answers');

        return view('admin.questions.edit',['quiz'=>$quiz,'question'=>$question]);
    }

    public function update(QuestionCreateRequest $request, Quiz $quiz, Question $question)
    {
        $data = $request->all();

        if($request->has('image')){
            
            $questionIndex = 1;
            foreach ($quiz->questions()->get() as $key => $q) {
                if($q->id == $question->id){
                    $questionIndex = $key+1;
                    break;
                }
            }

            $fileName=$questionIndex.'-'.Str::slug($data['question']).'.'.$request->image->extension();
            $fileDirectory = 'question-images/'.$quiz->id.'/'.$fileName;

            
            if($question->image && file_exists(public_path($question->image))){
                unlink(public_path($question->image));
            }

            // $request->image->move(public_path('question-images/'.$quiz->id),$fileName);
            $question->image=$fileDirectory;
        }

        $question->question=$data['question'];
        $question->save();
        
        $question->load('answers');

        foreach ($question->answers as $key => $answer) {
            $answer->update([
                'answer'=>$data['answers'][$key+1], 
                'type'=>$data['correct_answer']==($key+1)?'correct':'wrong'
            ]);
        }

        return redirect()->route('admin.quizzes.questions.edit',[
            'quiz'=>$quiz, 
            'question'=>$question
        ])->withSuccess('Sual yeniləndi!');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $quiz->questions()->whereId($question->id)->delete();

        if($question->image && file_exists(public_path($question->image))){
            unlink(public_path($question->image));
        }


        return redirect()->route('admin.quizzes.questions.index', ['quiz'=>$quiz])->withSuccess('Sual silindi!');

    }
}
