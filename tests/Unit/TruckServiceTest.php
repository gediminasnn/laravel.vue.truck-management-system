<?php

namespace Tests\Unit;

use App\Interfaces\ITruckRepository;
use App\Services\TruckService;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Models\Truck;

class TruckServiceTest extends TestCase
{
    /**
     * @var MockObject|ITruckRepository
     */
    private $mockTruckRepository;

    /**
     * @var TruckService
     */
    private $truckService;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockTruckRepository = $this->createMock(ITruckRepository::class);
        $this->truckService = new TruckService($this->mockTruckRepository);
    }

    public function testGetAllTrucksReturnsArrayOfTrucks()
    {
        $expectedTrucks = new Collection([
            new Truck(['id' => 1, 'unit_number' => 'TR001', 'year' => 2021, 'notes' => 'Truck 1']),
            new Truck(['id' => 2, 'unit_number' => 'TR002', 'year' => 2022, 'notes' => 'Truck 2']),
        ]);
        $this->mockTruckRepository->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedTrucks);

        $trucks = $this->truckService->getAllTrucks();

        $this->assertCount(2, $trucks);
        $this->assertEquals($expectedTrucks, $trucks);
    }

    public function testGetTruckByIdReturnsTruck()
    {
        $truckId = 1;
        $expectedTruck = new Truck([
            'id' => $truckId,
            'unit_number' => 'TR123',
            'year' => 2021,
            'notes' => 'Test Truck'
        ]);

        $this->mockTruckRepository->expects($this->once())
            ->method('find')
            ->with($truckId)
            ->willReturn($expectedTruck);

        $truck = $this->truckService->getTruckById($truckId);

        $this->assertNotNull($truck);
        $this->assertEquals($expectedTruck->id, $truck->id);
        $this->assertEquals($expectedTruck->unit_number, $truck->unit_number);
    }

    public function testGetTruckByIdReturnsNullWhenNotFound()
    {
        $truckId = 999;

        $this->mockTruckRepository->expects($this->once())
            ->method('find')
            ->with($truckId)
            ->willReturn(null);

        $truck = $this->truckService->getTruckById($truckId);

        $this->assertNull($truck);
    }

    public function testCreateTruck()
    {
        $truckData = [
            'unit_number' => 'TR123',
            'year' => 2021,
            'notes' => 'Test Truck',
        ];

        $expectedTruck = new Truck($truckData);

        $this->mockTruckRepository->expects($this->once())
            ->method('create')
            ->with($truckData)
            ->willReturn($expectedTruck);

        $truck = $this->truckService->createTruck($truckData);

        $this->assertNotNull($truck);
        $this->assertEquals($truckData['unit_number'], $truck->unit_number);
        $this->assertEquals($truckData['year'], $truck->year);
    }

    public function testUpdateTruckSuccess()
    {
        $truckId = 1;
        $truckData = [
            'unit_number' => 'TR124',
            'year' => 2022,
            'notes' => 'Updated Truck',
        ];

        $expectedTruck = new Truck($truckData);

        $this->mockTruckRepository->expects($this->once())
            ->method('update')
            ->with($truckId, $truckData)
            ->willReturn($expectedTruck);

        $truck = $this->truckService->updateTruck($truckId, $truckData);

        $this->assertNotNull($truck);
        $this->assertEquals($truckData['unit_number'], $truck->unit_number);
        $this->assertEquals($truckData['year'], $truck->year);
    }

    public function testUpdateTruckNotFound()
    {
        $truckId = 999;
        $truckData = [
            'unit_number' => 'TR999',
            'year' => 2023,
            'notes' => 'Non-existent Truck',
        ];

        $this->mockTruckRepository->expects($this->once())
            ->method('update')
            ->with($truckId, $truckData)
            ->willReturn(false);

        $truck = $this->truckService->updateTruck($truckId, $truckData);

        $this->assertFalse($truck);
    }

    public function testDeleteTruckSuccess()
    {
        $truckId = 1;

        $this->mockTruckRepository->expects($this->once())
            ->method('delete')
            ->with($truckId)
            ->willReturn(true);

        $result = $this->truckService->deleteTruck($truckId);

        $this->assertTrue($result);
    }

    public function testDeleteTruckNotFound()
    {
        $truckId = 999;

        $this->mockTruckRepository->expects($this->once())
            ->method('delete')
            ->with($truckId)
            ->willReturn(false);

        $result = $this->truckService->deleteTruck($truckId);

        $this->assertFalse($result);
    }
}
