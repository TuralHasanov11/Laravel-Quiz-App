<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth','isAdmin'])->group(function(){
    Route::resource('quizzes',Admin\QuizzesController::class);
    Route::resource('quizzes.questions',Admin\QuestionsController::class);
    Route::resource('quizzes.questions.answers',Admin\AnswersController::class);
});