<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTruckSubunitRequest;
use App\Interfaces\ITruckSubunitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TruckSubunitController extends Controller
{
    protected $truckSubunitService;

    public function __construct(ITruckSubunitService $truckSubunitService)
    {
        $this->truckSubunitService = $truckSubunitService;
    }

    public function store(StoreTruckSubunitRequest $request): JsonResponse
    {
        try {
            $truckSubunit = $this->truckSubunitService->createSubunit($request->validated());
            return response()->json($truckSubunit, 201);
        } catch (\Exception $e) {
            Log::error('Error assigning subunit: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to assign subunit'.$e->getMessage()], 500);
        }
    }
}
