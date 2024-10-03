<?php

namespace App\Rules;

use Closure;
use App\Models\TruckSubunit;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class NoSubunitOverlap implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $overlapExists = TruckSubunit::where('main_truck_id', $value)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->data['start_date'], $this->data['end_date']])
                      ->orWhereBetween('end_date', [$this->data['start_date'], $this->data['end_date']])
                      ->orWhere(function ($query) {
                          $query->where('start_date', '<=', $this->data['start_date'])
                                ->where('end_date', '>=', $this->data['end_date']);
                      });
            })
            ->exists();

        if ($overlapExists) {
            $fail('This truck already has a subunit assigned during the selected dates.');
        }
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
