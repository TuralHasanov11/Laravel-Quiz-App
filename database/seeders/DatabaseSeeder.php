<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UserSeeder::class, // 1
            // QuizSeeder::class, // 2
            // QuestionSeeder::class,
            AnswerSeeder::class,
        ]);

    }
}
