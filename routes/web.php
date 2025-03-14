<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('vehicles', VehicleController::class);
Route::resource('drivers', DriverController::class);

Route::resource('trips', TripController::class);
Route::get('/trips/{trip}/finish', [TripController::class, 'finishForm'])->name('trips.finishForm');
Route::post('/trips/{trip}/finish', [TripController::class, 'finish'])->name('trips.finish');
Route::get('/trips/{trip}/edit-ongoing', [TripController::class, 'editOngoing'])->name('trips.edit-ongoing');
Route::put('/trips/{trip}/edit-ongoing', [TripController::class, 'updateOngoing'])->name('trips.update-ongoing');
Route::get('/trips/{trip}/edit-completed', [TripController::class, 'editCompleted'])->name('trips.edit-completed');
Route::put('/trips/{trip}/edit-completed', [TripController::class, 'updateCompleted'])->name('trips.update-completed');
