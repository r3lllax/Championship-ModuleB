<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->title(30),
            'description'=>fake()->text(100),
            'duration'=>fake()->randomDigit(),
            'price'=>fake()->randomDigit(),
            'start_date'=>fake()->date(),
            'end_date'=>fake()->date(),
            'volume'=>fake()->word() . ".jpg",
        ];
    }
}
