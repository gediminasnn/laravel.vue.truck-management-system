<?php

namespace Database\Factories;

use App\Models\Truck;
use App\Models\TruckSubunit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TruckSubunit>
 */
class TruckSubunitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'main_truck_id' => Truck::factory()->create()->id,
            'subunit_truck_id' => Truck::factory()->create()->id,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
