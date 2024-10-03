<?php

namespace App\Repositories;

use App\Interfaces\ITruckSubunitRepository;
use App\Models\Truck;
use App\Models\TruckSubunit;
use Illuminate\Database\Eloquent\Model;

class TruckSubunitRepository implements ITruckSubunitRepository
{
    public function create(array $data): Model
    {
        return TruckSubunit::create($data);
    }
}
