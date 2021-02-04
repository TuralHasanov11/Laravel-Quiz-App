<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['question','image'];

    protected $appends=['correct_answer', 'current_user', 'correct_percentage'];

    public function quiz(){
        return $this->belongsTo('App\Models\Quiz');
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'question_user')
                        ->withPivot('answer')
                        ->withTimestamps();
    }

    public function getCorrectAnswerAttribute(){
        return $this->answers()->where('type', 'correct')->first();
    }

    public function getCurrentUserAttribute(){
        return $this->users()->find(auth()->id());
    }

    public function getCorrectPercentageAttribute(){
        $usersAnswersCount = $this->users()->count();
        $correctAnswersCount = $this->users()->where('answer',$this->correct_answer->id)->count();

        return round($correctAnswersCount/$usersAnswersCount*100);
    }
}
