<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = ['pending','success','failed'];
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'course_id'=>Course::inRandomOrder()->first()->id,
            'date'=>$this->faker->date(),
            'payment_status'=>fake()->randomElement($options),
        ];
    }
}
