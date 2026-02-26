<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    

public function definition(): array
{
    $user = \App\Models\User::inRandomOrder()->first();

    $image = $this->faker->image(
        storage_path('app/public/posts'),
        640,
        480,
        'nature',
        false
    );

    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph,
        'user_id' => $user->id,
        'state_id' => $user->state_id,
        'image' => 'posts/' . $image,
    ];
}
}
