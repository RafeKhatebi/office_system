<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UserController::class, 'login']);

// Employees routes
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/payrolls', PayrollController::class);
    Route::apiResource('/expenses', ExpenseController::class);
});
