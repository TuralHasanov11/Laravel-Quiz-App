<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\MainController;


Route::get('/', function () {
    return view('welcome');
});

route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [MainController::class,'dashboard'])->name('dashboard');

    Route::get('quizzes/{slug}', [MainController::class,'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}/result', [MainController::class,'result'])->name('quizzes.result');
    Route::get('quizzes/{slug}/details', [MainController::class,'details'])->name('quizzes.details');

});

Route::prefix('admin')->name('admin.')->middleware(['auth','isAdmin'])->group(function(){
    Route::resource('quizzes',Admin\QuizzesController::class);
    Route::resource('quizzes.questions',Admin\QuestionsController::class);
    Route::resource('quizzes.questions.answers',Admin\AnswersController::class);
});