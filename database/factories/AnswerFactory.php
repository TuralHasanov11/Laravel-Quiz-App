<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $types=['correct','wrong'];
        return [
            'answer'=>$this->faker->sentence(rand(3,5)),
            'type'=>'wrong',
            'question_id'=>rand(9,30)
        ];
    }
}
