<?php

namespace App\Services;

use App\Interfaces\ITruckSubunitRepository;
use App\Interfaces\ITruckSubunitService;
use App\Models\TruckSubunit;

class TruckSubunitService implements ITruckSubunitService
{
    protected $truckSubunitRepository;

    public function __construct(ITruckSubunitRepository $truckSubunitRepository)
    {
        $this->truckSubunitRepository = $truckSubunitRepository;
    }

    public function createSubunit(array $data): TruckSubunit
    {
        return $this->truckSubunitRepository->create($data);
    }
}
