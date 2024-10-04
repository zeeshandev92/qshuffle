<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'relation_id' => 1,
            'gender' => 'female',
            'question' => 'Is Apple a large technology company?',
            'type' => 'free_text',
        ]);
    }
}
