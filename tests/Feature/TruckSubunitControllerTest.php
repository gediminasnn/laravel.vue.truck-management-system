<?php

namespace Tests\Feature;

use App\Models\Truck;
use App\Models\TruckSubunit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TruckSubunitControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getCsrfToken()
    {
        $response = $this->get('/token');
        return $response->getContent();
    }

    public function testCreateTruckSubunitSuccess()
    {
        $csrfToken = $this->getCsrfToken();

        $mainTruck = Truck::factory()->create();
        $subunitTruck = Truck::factory()->create();

        $truckSubunitData = [
            'main_truck_id' => $mainTruck->id,
            'subunit_truck_id' => $subunitTruck->id,
            'start_date' => '2024-10-01',
            'end_date' => '2024-12-31',
        ];

        $response = $this->postJson(route('truck-subunits.store'), $truckSubunitData, [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'main_truck_id' => $truckSubunitData['main_truck_id'],
                'subunit_truck_id' => $truckSubunitData['subunit_truck_id'],
                'start_date' => $truckSubunitData['start_date'],
                'end_date' => $truckSubunitData['end_date'],
            ]);

        $this->assertDatabaseHas('truck_subunits', $truckSubunitData);
    }
}
