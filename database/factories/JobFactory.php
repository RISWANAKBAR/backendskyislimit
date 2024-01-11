<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{ protected $model = Job::class;

    public function definition()
    {
        return [
            'job_name' => $this->faker->jobTitle,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            // Add other attributes as needed
        ];
    }
}
