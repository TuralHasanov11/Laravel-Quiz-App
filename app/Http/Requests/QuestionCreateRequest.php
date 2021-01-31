<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'=>'required|min:3',
            'image'=>'nullable|image|max:1999',
            'answers'=>'required|array|size:4',
            'answers.*'=>'required|string|distinct|max:191',
            'correct_answer'=>'required|integer|between:1,4'
        ];
    }

    public function attributes()
    {
        return [
            'question'=>'Sual',
            'image'=>'Şəkil',
            'answers'=>'Cavablar',
            'answers.*'=>'Cavab',
            'correct_answer'=>'Düzgün cavab'
        ];
    }
}
