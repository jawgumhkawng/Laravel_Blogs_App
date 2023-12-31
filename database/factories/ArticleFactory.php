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
        return [
        'title' => $this->faker->sentence,
        "user_id" => rand(1,2),
        'body' => $this->faker->paragraph,
        'category_id' => rand(1, 5),
        'image' =>$this->faker->image('public/storage/images',640,480, null, false),

        ];
    }
}
