<?php

namespace App\Http\Requests;

use App\Rules\MainTruckNotSubunit;
use App\Rules\NoSubunitOverlap;
use Illuminate\Foundation\Http\FormRequest;

class StoreTruckSubunitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'main_truck_id' => [
                'required',
                'different:subunit_truck_id',
                new MainTruckNotSubunit(),
                new NoSubunitOverlap(),
            ],
            'subunit_truck_id' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
        ];
    }

    public function attributes(): array
    {
        return [
            'main_truck_id' => 'main truck',
            'subunit_truck_id' => 'subunit truck',
        ];
    }
}
