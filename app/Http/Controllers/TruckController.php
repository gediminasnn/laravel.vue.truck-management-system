<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckRequest;
use App\Interfaces\ITruckService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TruckController extends Controller
{
    protected $truckService;

    public function __construct(ITruckService $truckService)
    {
        $this->truckService = $truckService;
    }

    public function index(): JsonResponse
    {
        try {
            $trucks = $this->truckService->getAllTrucks();
            return response()->json($trucks);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to retrieve trucks'], 500);
        }
    }

    public function store(TruckRequest $request): JsonResponse
    {
        try {
            $truck = $this->truckService->createTruck($request->validated());
            return response()->json($truck, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to create truck'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $truck = $this->truckService->getTruckById($id);
            if (!$truck) {
                return response()->json(['message' => 'Truck not found'], 404);
            }
            return response()->json($truck);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to retrieve truck'], 500);
        }
    }

    public function update(TruckRequest $request, $id): JsonResponse
    {
        try {
            $updated = $this->truckService->updateTruck($id, $request->validated());
            if (!$updated) {
                return response()->json(['message' => 'Truck not found'], 404);
            }
            return response()->json($updated);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to update truck'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->truckService->deleteTruck($id);
            if (!$deleted) {
                return response()->json(['message' => 'Truck not found'], 404);
            }
            return response()->json([], 204);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to delete truck'], 500);
        }
    }
}
