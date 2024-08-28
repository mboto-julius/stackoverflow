<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ussers')->delete();
        DB::table('questions')->delete();
        DB::table('answers')->delete();

        \App\Models\User::factory()
            ->count(3)
            ->create()
            ->each(function ($u) {
                $u->questions()->saveMany(
                    \App\Models\Question::factory()->count(rand(1, 5))->make()
                )->each(function ($q) {
                    $answers = \App\Models\Answer::factory()->count(rand(1, 5))->make();
                    $q->answers()->saveMany($answers);

                    // Update the answers_count field after saving answers
                    $q->update(['answers_count' => $q->answers()->count()]);
                });
            });
    }
}
