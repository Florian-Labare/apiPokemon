<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout/{userId}', [AuthController::class, 'logout']);
    
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard/{offset}', [DashboardController::class, 'dashboard']);
    Route::get('/pokemon/{name}', [DashboardController::class, 'displayPokemon']);
});
