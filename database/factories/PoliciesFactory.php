<?php

namespace Database\Factories;

use App\Models\Policies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Policies>
 */
class PoliciesFactory extends Factory
{
    protected $model = Policies::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->countryCode(),
            'plan_reference' => 'The Calpe RBS No. 247',
            'first_name'=>fake()->firstName(),
            'last_name'=>fake()->lastName(),
            'investment_house'=>fake()->company(),
            'last_operation'=>fake()->date()

        ];
    }
}

