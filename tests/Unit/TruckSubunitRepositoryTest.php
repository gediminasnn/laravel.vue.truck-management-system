<?php

namespace Tests\Unit\Repositories;

use App\Models\Truck;
use App\Models\TruckSubunit;
use App\Repositories\TruckSubunitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TruckSubunitRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTruckSubunit()
    {
        $mainTruck = Truck::factory()->create();
        $subunitTruck = Truck::factory()->create();

        $truckSubunitData = [
            'main_truck_id' => $mainTruck->id,
            'subunit_truck_id' => $subunitTruck->id,
            'start_date' => '2024-10-01',
            'end_date' => '2024-12-31',
        ];

        $repository = new TruckSubunitRepository();
        $truckSubunit = $repository->create($truckSubunitData);

        $this->assertInstanceOf(TruckSubunit::class, $truckSubunit);
        $this->assertDatabaseHas('truck_subunits', $truckSubunitData);
    }
}
