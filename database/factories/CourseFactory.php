<?php

namespace Database\Factories;

use App\Models\Centre;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->words(3, true),
            'time' => $this->faker->time(),
            'subject' => $this->faker->randomElement(['Biology', 'History', 'Mathematics', 'Literature', 'Chemistry', 'Physics', 'Sociology', 'Psychology', 'Economics', 'Political Science', 'Computer Science', 'Art History', 'Environmental Science', 'Philosophy', 'Anthropology', 'Linguistics', 'Astronomy', 'Geology', 'Statistics', 'Business Administration', 'Communications', 'Cultural Studies', 'Engineering', 'Music Theory', 'Education', 'Geography', 'Nutrition', 'Criminology', 'Architecture']),
            'centre_id' => Centre::inRandomOrder()->first()
        ];
    }
}
