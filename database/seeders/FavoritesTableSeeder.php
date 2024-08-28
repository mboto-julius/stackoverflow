<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
Use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('favorites')->delete();

        $userId = User::pluck('id')->all();
        $numberOfUsers = count($userId);

        $questions = Question::all();

        foreach($questions as $question){
            for($i=0; $i < rand(0, $numberOfUsers); $i++){
                $user = $userId[$i];
                $question->favorites()->attach($user);  
            }
        }
    }
}
