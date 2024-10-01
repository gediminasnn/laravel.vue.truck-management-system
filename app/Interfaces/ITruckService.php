<?php

namespace App\Interfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ITruckService
{
    public function getAllTrucks(): Collection;
    public function getTruckById($id): Model|null;
    public function createTruck(array $data): Model;
    public function updateTruck($id, array $data): Model|false;
    public function deleteTruck($id);
}
