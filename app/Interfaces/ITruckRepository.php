<?php

namespace App\Interfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ITruckRepository
{
    public function getAll(): Collection;
    public function find($id): Model|null;
    public function create(array $data): Model;
    public function update($id, array $data): Model|false;
    public function delete($id): bool;
}
