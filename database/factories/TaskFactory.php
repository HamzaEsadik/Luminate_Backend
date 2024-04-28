<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(100),
            'description' => fake()->text(2000),
            'start_at' => fake()->date(),
            'ends_at' => fake()->date(),
            'done' => fake()->boolean(),
        ];
    }
}
