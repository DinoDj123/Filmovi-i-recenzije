<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=$this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' =>Str::slug($title),
            'short_description' => $this->faker->sentences(2, true),
            'review' => $this->faker->paragraph(),
            'picture' => 'storage/app/public/posters/default.jpg',
            'published_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => User::factory(),
        ];
    }
}
