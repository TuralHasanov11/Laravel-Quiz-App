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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('admin.questions.index', [
            'quiz'=>$quiz
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create',['quiz'=>$quiz]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, Quiz $quiz)
    {
        $data = $request->all();
        
        if($request->has('image')){
            $fileName=Str::slug($data['question']).'_'.time().'.'.$data['image']->extension();
            $fileDirectory = 'question-images/'.$fileName;
            // $request->image->move(public_path('question-images'),$fileName);
            $request->image->storeAs('public/question-images',$fileName);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quiz, $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz,Question $question)
    {
        $question->load('answers');

        return view('admin.questions.edit',['quiz'=>$quiz,'question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionCreateRequest $request, Quiz $quiz, Question $question)
    {
        $data = $request->all();

        if($request->has('image')){
            $fileName=Str::slug($data['question']).'_'.time().'.'.$data['image']->extension();
            $fileDirectory = 'question-images/'.$fileName;
            $request->image->storeAs('public/question-images',$fileName);
            Storage::delete('public/'.$question->image);
        }

        $question->question=$data['question'];
        if(isset($fileDirectory)){
            $question->image=$fileDirectory;
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz, Question $question)
    {
        $quiz->questions()->whereId($question->id)->delete();

        return redirect()->route('admin.quizzes.questions.index', ['quiz'=>$quiz])->withSuccess('Sual silindi!');

    }
}
