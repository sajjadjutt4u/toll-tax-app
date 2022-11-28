<?php

use App\Http\Controllers\VehicleTollDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/entry', [VehicleTollDetailController::class, 'storeEntryData']);
Route::post('/calculate-tax', [VehicleTollDetailController::class, 'calculateTollTax']);
