<?php

namespace Tests\Unit\Rules;

use App\Models\Truck;
use App\Models\TruckSubunit;
use App\Rules\NoSubunitOverlap;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class NoSubunitOverlapTest extends TestCase
{
    public function itFailsWhenThereIsASubunitOverlap()
    {
        $mainTruck = Truck::factory()->create();

        TruckSubunit::factory()->create([
            'main_truck_id' => $mainTruck->id,
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-10',
        ]);

        $validator = Validator::make(
            [
                'main_truck_id' => $mainTruck->id,
                'start_date' => '2024-01-05',
                'end_date' => '2024-01-15',
            ],
            [
                'main_truck_id' => [new NoSubunitOverlap()],
            ]
        );

        $this->assertTrue($validator->fails());
        $this->assertEquals('This truck already has a subunit assigned during the selected dates.', $validator->errors()->first('main_truck_id'));
    }

    public function itPassesWhenThereIsNoSubunitOverlap()
    {
        $mainTruck = Truck::factory()->create();

        TruckSubunit::factory()->create([
            'main_truck_id' => $mainTruck->id,
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-10',
        ]);

        $validator = Validator::make(
            [
                'main_truck_id' => $mainTruck->id,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25',
            ],
            [
                'main_truck_id' => [new NoSubunitOverlap()],
            ]
        );

        $this->assertTrue($validator->passes());
    }
}
