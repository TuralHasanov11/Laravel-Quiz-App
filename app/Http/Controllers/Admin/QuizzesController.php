<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use Illuminate\Support\Str;


class QuizzesController extends Controller
{
    
    public function index()
    {
        $quizzes=Quiz::withCount('questions');

        if(request()->get('title')){
            $quizzes=$quizzes->where('title', 'LIKE', "%".request()->get('title')."%");
        }

        if(request()->get('status')){
            $quizzes=$quizzes->where('status', request()->get('status'));
        }

        $quizzes=$quizzes->paginate(10);

        return view('admin.quizzes.index', ['quizzes'=>$quizzes]);
    }

    
    public function create()
    {
        return view('admin.quizzes.create');
    }

    
    public function store(QuizCreateRequest $request)
    {
        $data = $request->post();
        $data = array_merge($data,['slug'=>Str::slug($data['title'])]);

        Quiz::create($data);

        return redirect()->route('admin.quizzes.index')->withSuccess('Quiz əlavə olundu!');
    }

    
    public function show(Quiz $quiz)
    {

        $quiz->load(['users', 'topTenUsers'])->loadCount(['questions']);

        // return $quiz;

        return view('admin.quizzes.show',['quiz'=>$quiz]);
    }

   
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->findOrFail($id);

        return view('admin.quizzes.edit',['quiz'=>$quiz]);
    }

  
    public function update(QuizUpdateRequest $request, $id)
    {
        $data = $request->only(['title','description','finished_at', 'status']);
        $data = array_merge($data,['slug'=>Str::slug($data['title'])]);

        $quiz = Quiz::findOrFail($id);
        
        $quiz->update($data);

        return redirect()->route('admin.quizzes.edit', ['quiz'=>$quiz->id])->withSuccess('Quiz yeniləndi!');
    }

   
    public function destroy(Quiz $quiz)
    {
        foreach ($quiz->questions()->get() as $key => $question) {
            if($question->image && file_exists(public_path($question->image))){
                unlink(public_path($question->image));
            }
        }
        
        $quiz->delete();

        rmdir(public_path('question-images').'/'.$quiz->id);

        return redirect()->route('admin.quizzes.index')->withSuccess('Quiz silindi!');
    }
}
