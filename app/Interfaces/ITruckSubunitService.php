<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ITruckSubunitService
{
    public function createSubunit(array $data): Model;
}
