<?php

namespace Tests\Feature;

use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TruckControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getCsrfToken()
    {
        $response = $this->get('/token');
        return $response->getContent();
    }


    public function testGetAllTrucksSuccess()
    {
        Truck::factory()->count(3)->create();

        $response = $this->getJson(route('trucks.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => ['id', 'unit_number', 'year', 'notes', 'created_at', 'updated_at']
            ]);
    }

    public function testCreateTruckSuccess()
    {
        $csrfToken = $this->getCsrfToken();

        $truckData = [
            'unit_number' => 'TR123',
            'year' => 2021,
            'notes' => 'This is a new truck'
        ];

        $response = $this->postJson(route('trucks.store'), $truckData, [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'unit_number' => $truckData['unit_number'],
                'year' => $truckData['year'],
                'notes' => $truckData['notes']
            ]);

        $this->assertDatabaseHas('trucks', $truckData);
    }

    public function testGetTruckByIdSuccess()
    {
        $truck = Truck::factory()->create();

        $response = $this->getJson(route('trucks.show', ['id' => $truck->id]));

        $response->assertStatus(200)
            ->assertJson([
                'id' => $truck->id,
                'unit_number' => $truck->unit_number,
                'year' => $truck->year,
                'notes' => $truck->notes
            ]);
    }

    public function testGetTruckByIdNotFound()
    {
        $response = $this->getJson(route('trucks.show', ['id' => 999]));

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Truck not found'
            ]);
    }

    public function testUpdateTruckSuccess()
    {
        $csrfToken = $this->getCsrfToken();

        $truck = Truck::factory()->create();

        $updateData = [
            'unit_number' => 'TR456',
            'year' => 2022,
            'notes' => 'Updated truck information'
        ];

        $response = $this->putJson(route('trucks.update', ['id' => $truck->id]), $updateData, [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'unit_number' => $updateData['unit_number'],
                'year' => $updateData['year'],
                'notes' => $updateData['notes'],
            ]);


        $this->assertDatabaseHas('trucks', $updateData);
    }

    public function testUpdateTruckNotFound()
    {
        $csrfToken = $this->getCsrfToken();

        $updateData = [
            'unit_number' => 'TR789',
            'year' => 2023,
            'notes' => 'Non-existent truck update'
        ];

        $response = $this->putJson(route('trucks.update', ['id' => 999]), $updateData, [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Truck not found'
            ]);
    }

    public function testDeleteTruckSuccess()
    {
        $csrfToken = $this->getCsrfToken();

        $truck = Truck::factory()->create();

        $response = $this->deleteJson(route('trucks.destroy', ['id' => $truck->id]), [], [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('trucks', ['id' => $truck->id]);
    }

    public function testDeleteTruckNotFound()
    {
        $csrfToken = $this->getCsrfToken();

        $response = $this->deleteJson(route('trucks.destroy', ['id' => 999]), [], [
            'X-CSRF-TOKEN' => $csrfToken
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Truck not found'
            ]);
    }
}
