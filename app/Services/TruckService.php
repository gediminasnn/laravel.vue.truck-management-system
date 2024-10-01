<?php

namespace App\Services;
use App\Interfaces\ITruckRepository;
use App\Interfaces\ITruckService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class TruckService implements ITruckService
{
    protected $truckRepository;

    public function __construct(ITruckRepository $truckRepository)
    {
        $this->truckRepository = $truckRepository;
    }

    public function getAllTrucks(): Collection
    {
        return $this->truckRepository->getAll();
    }

    public function getTruckById($id): Model|null
    {
        return $this->truckRepository->find($id);
    }

    public function createTruck(array $data): Model
    {
        return $this->truckRepository->create($data);
    }

    public function updateTruck($id, array $data): Model|false
    {
        return $this->truckRepository->update($id, $data);
    }

    public function deleteTruck($id): bool
    {
        return $this->truckRepository->delete($id);
    }
}
