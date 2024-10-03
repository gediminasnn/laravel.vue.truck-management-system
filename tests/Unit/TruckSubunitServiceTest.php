<?php

namespace Tests\Unit\Services;

use App\Models\TruckSubunit;
use App\Services\TruckSubunitService;
use App\Interfaces\ITruckSubunitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TruckSubunitServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $mockTruckSubunitRepository;
    protected $truckSubunitService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockTruckSubunitRepository = $this->createMock(ITruckSubunitRepository::class);
        $this->truckSubunitService = new TruckSubunitService($this->mockTruckSubunitRepository);
    }

    public function testCreateSubunit()
    {
        $truckSubunitData = [
            'main_truck_id' => 1,
            'subunit_truck_id' => 2,
            'start_date' => '2024-10-01',
            'end_date' => '2024-12-31',
        ];

        $expectedTruckSubunit = new TruckSubunit($truckSubunitData);

        $this->mockTruckSubunitRepository->expects($this->once())
            ->method('create')
            ->with($truckSubunitData)
            ->willReturn($expectedTruckSubunit);

        $result = $this->truckSubunitService->createSubunit($truckSubunitData);

        $this->assertInstanceOf(TruckSubunit::class, $result);
        $this->assertEquals($expectedTruckSubunit, $result);
    }
}
