<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(4),
            'content' => $this->faker->paragraphs(rand(3,7), true),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            'image' => null, // leave null or set to sample path if you want
            'published' => true,

            // add user_id if your articles table requires it; else remove/comment
            // 'user_id' => 1,
        ];
    }
}
