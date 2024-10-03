<?php

namespace App\Rules;

use Closure;
use App\Models\TruckSubunit;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class MainTruckNotSubunit implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isSubunit = TruckSubunit::where('subunit_truck_id', $value)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->data['start_date'], $this->data['end_date']])
                      ->orWhereBetween('end_date', [$this->data['start_date'], $this->data['end_date']])
                      ->orWhere(function ($query) {
                          $query->where('start_date', '<=', $this->data['start_date'])
                                ->where('end_date', '>=', $this->data['end_date']);
                      });
            })
            ->exists();

        if ($isSubunit) {
            $fail('Main truck is already assigned as a subunit during the selected dates and cannot be assigned its own subunit.');
        }
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
