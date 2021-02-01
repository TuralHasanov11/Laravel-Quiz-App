<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'title', 'description', 'finished_at', 'status', 'slug'
    ];

    protected $dates=['finished_at'];

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;
    }

    public function getQuizDate(){
        $date = Carbon::parse($this->finished_at);
        return $date->isoFormat('ll');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    
}
