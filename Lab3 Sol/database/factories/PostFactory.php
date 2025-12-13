<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  public function definition(): array
  {
    return [
      'title' => fake()->unique()->sentence(),
      'description' => fake()->paragraph(3),
      'post_creator' => function () {
        $user = User::inRandomOrder()->first();
        return $user ? $user->name : User::factory()->create()->name;
      },
    ];
  }
}
