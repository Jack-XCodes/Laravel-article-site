<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'content' => $this->faker->paragraphs(5, true),
            'author' => $this->faker->name,
            'slug' => \Str::slug($title) . '-' . $this->faker->unique()->randomNumber(),
            'published_at' => $this->faker->optional()->dateTimeThisYear(),
            'image' => $this->faker->imageUrl(640, 426, 'dev', true, 'Dev'),
        ];
    }
}
