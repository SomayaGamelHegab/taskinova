<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rate'        => rand(1, 5),
            'comment'         => $this->faker->paragraph(30),
            'user_id'      => rand(1, 10),
            'post_id'      => rand(1, 10),
        ];
    }
}
