<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id'=> 1,
            'user_id'       => 1,
            'title'         => 'Customer Satisfaction Survey',
            'description'   => 'A survey to gauge customer satisfaction levels.',
            'start_date'    => now(),
            'end_date'      => now()->addMonth(),
            'is_anonymous'  => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
