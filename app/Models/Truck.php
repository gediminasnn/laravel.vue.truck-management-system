<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'year',
        'notes',
    ];

    public function getSubunits(): HasMany
    {
        return $this->hasMany(TruckSubunit::class, 'main_truck_id');
    }

    public function getSubunitOf(): HasMany
    {
        return $this->hasMany(TruckSubunit::class, 'subunit_truck_id');
    }
}
