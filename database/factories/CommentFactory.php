<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'comment' => $this->faker->sentences(rand(1,3), true),
            'approved' => $this->faker->boolean(60), // 60% approved
            'article_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
