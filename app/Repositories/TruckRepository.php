<?php

namespace App\Repositories;

use App\Interfaces\ITruckRepository;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TruckRepository implements ITruckRepository
{

    public function getAll(): Collection
    {
        return Truck::all();
    }

    public function find($id): Model|null
    {
        return Truck::find($id);
    }

    public function create(array $data): Model
    {
        return Truck::create($data);
    }

    public function update($id, array $data): Model|false
    {
        $truck = Truck::find($id);
        if (!$truck) {
            return false;
        }
        $truck->update($data);
        return $truck;
    }

    public function delete($id): bool
    {
        $truck = Truck::find($id);
        if (!$truck) {
            return false;
        }
        return $truck->delete();
    }
}
