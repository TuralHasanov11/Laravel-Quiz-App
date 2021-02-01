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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes=Quiz::withCount('questions');

        if(request()->get('title')){
            $quizzes=$quizzes->where('title', 'LIKE', "%".request()->get('title')."%");
        }

        if(request()->get('status')){
            $quizzes=$quizzes->where('status', request()->get('status'));
        }

        $quizzes=$quizzes->paginate(5);

        return view('admin.quizzes.index', ['quizzes'=>$quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        $data = $request->post();
        $data = array_merge($data,['slug'=>Str::slug($data['title'])]);

        Quiz::create($data);

        return redirect()->route('admin.quizzes.index')->withSuccess('Quiz əlavə olundu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->findOrFail($id);

        return view('admin.quizzes.edit',['quiz'=>$quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $data = $request->only(['title','description','finished_at', 'status']);
        $data = array_merge($data,['slug'=>Str::slug($data['title'])]);

        $quiz = Quiz::findOrFail($id);
        
        $quiz->update($data);

        return redirect()->route('admin.quizzes.edit', ['quiz'=>$quiz->id])->withSuccess('Quiz yeniləndi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')->withSuccess('Quiz silindi!');
    }
}
