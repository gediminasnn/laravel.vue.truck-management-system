<?php

namespace Tests\Unit;

use App\Models\Truck;
use App\Repositories\TruckRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TruckRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllTrucks()
    {
        Truck::factory()->count(3)->create();

        $repository = new TruckRepository();
        $trucks = $repository->getAll();

        $this->assertCount(3, $trucks);
        $this->assertEquals(3, Truck::count());
    }

    public function testFindTruckById()
    {
        $truck = Truck::factory()->create();

        $repository = new TruckRepository();
        $foundTruck = $repository->find($truck->id);

        $this->assertNotNull($foundTruck);
        $this->assertEquals($truck->id, $foundTruck->id);
        $this->assertEquals($truck->unit_number, $foundTruck->unit_number);
    }

    public function testFindTruckByIdNotFound()
    {
        $repository = new TruckRepository();
        $foundTruck = $repository->find(999);

        $this->assertNull($foundTruck);
    }

    public function testCreateTruck()
    {
        $truckData = [
            'unit_number' => 'TR123',
            'year' => 2021,
            'notes' => 'This is a new truck',
        ];

        $repository = new TruckRepository();
        $createdTruck = $repository->create($truckData);

        $this->assertNotNull($createdTruck);
        $this->assertDatabaseHas('trucks', $truckData);
    }

    public function testUpdateTruck()
    {
        $truck = Truck::factory()->create([
            'unit_number' => 'TR123',
            'year' => 2020,
            'notes' => 'Old notes'
        ]);

        $updateData = [
            'unit_number' => 'TR456',
            'year' => 2021,
            'notes' => 'Updated notes'
        ];

        $repository = new TruckRepository();
        $updatedTruck = $repository->update($truck->id, $updateData);

        $this->assertNotNull($updatedTruck);
        $this->assertEquals('TR456', $updatedTruck->unit_number);
        $this->assertEquals(2021, $updatedTruck->year);
        $this->assertDatabaseHas('trucks', $updateData);
    }

    public function testUpdateTruckNotFound()
    {
        $updateData = [
            'unit_number' => 'TR789',
            'year' => 2023,
            'notes' => 'Non-existent truck'
        ];

        $repository = new TruckRepository();
        $updatedTruck = $repository->update(999, $updateData);

        $this->assertFalse($updatedTruck);
    }

    public function testDeleteTruck()
    {
        $truck = Truck::factory()->create();

        $repository = new TruckRepository();
        $deleted = $repository->delete($truck->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('trucks', ['id' => $truck->id]);
    }

    public function testDeleteTruckNotFound()
    {
        $repository = new TruckRepository();
        $deleted = $repository->delete(999);

        $this->assertFalse($deleted);
    }
}
