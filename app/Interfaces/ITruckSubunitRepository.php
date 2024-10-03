<?php

namespace App\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface ITruckSubunitRepository
{
    public function create(array $data): Model;
}
