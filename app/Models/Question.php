<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['question','image'];

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
}
