<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = rtrim(fake()->sentence(), ".");
        $createdAt = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'title' => $title,
            'slug' => Str::slug($title, '-'), 
            'body' => fake()->paragraphs(rand(3, 7), true),
            'views' => rand(0, 10),
            'answers_count' => rand(0, 10),
            'votes' => rand(-3, 10),
            'best_answer_id' => null,
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }
}
