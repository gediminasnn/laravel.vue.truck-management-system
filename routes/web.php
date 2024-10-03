<?php

use App\Http\Controllers\TruckController;
use App\Http\Controllers\TruckSubunitController;
use Illuminate\Support\Facades\Route;

Route::get('/token', function () {
    return csrf_token();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('trucks', [TruckController::class, 'index'])->name('trucks.index');
Route::post('trucks', [TruckController::class, 'store'])->name('trucks.store');
Route::get('trucks/{id}', [TruckController::class, 'show'])->name('trucks.show');
Route::put('trucks/{id}', [TruckController::class, 'update'])->name('trucks.update');
Route::delete('trucks/{id}', [TruckController::class, 'destroy'])->name('trucks.destroy');

Route::post('subunits', [TruckSubunitController::class, 'store'])->name('truck-subunits.store');
