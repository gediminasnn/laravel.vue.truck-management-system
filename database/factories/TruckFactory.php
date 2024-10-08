<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truck>
 */
class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unit_number' => $this->faker->unique()->numerify('SEED-#####'),
            'year' => $this->faker->year(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
