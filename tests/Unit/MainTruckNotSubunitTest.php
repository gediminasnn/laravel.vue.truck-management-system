<?php

namespace Tests\Unit\Rules;

use App\Models\Truck;
use App\Models\TruckSubunit;
use App\Rules\MainTruckNotSubunit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class MainTruckNotSubunitTest extends TestCase
{
    public function itPassesIfMainTruckIsNotASubunitWithinGivenDates()
    {
        $truck = Truck::factory()->create();

        $data = [
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
        ];

        $validator = Validator::make(
            [
                'truck_id' => $truck->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ],
            ['truck_id' => [new MainTruckNotSubunit()]]
        );

        $this->assertTrue($validator->passes());
    }

    public function itFailsIfMainTruckIsSubunitWithinGivenDates()
    {
        $truck = Truck::factory()->create();
        $subunitTruck = Truck::factory()->create();

        TruckSubunit::factory()->create([
            'main_truck_id' => $truck->id,
            'subunit_truck_id' => $subunitTruck->id,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
        ]);

        $validator = Validator::make(
            [
                'truck_id' => $subunitTruck->id,
                'start_date' => now()->addDays(1)->toDateString(),
                'end_date' => now()->addDays(5)->toDateString(),
            ],
            ['truck_id' => [new MainTruckNotSubunit()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertEquals(
            'Main truck is already assigned as a subunit during the selected dates and cannot be assigned its own subunit.',
            $validator->errors()->first('truck_id')
        );
    }
}
