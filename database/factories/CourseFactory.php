<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'short_description' => $this->faker->sentence(10),
            'teacher_id' => User::factory(),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'enrolled_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
