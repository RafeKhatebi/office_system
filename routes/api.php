<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\FinancialReportController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\IncomeResourceController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WithdrawalController;
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
    Route::apiResource('/withdrawals', WithdrawalController::class);
    Route::apiResource('/income_resources', IncomeResourceController::class);
    Route::apiResource('/incomes', IncomeController::class);
    Route::post('/financial_reports', [FinancialReportController::class, 'financialSummary']);
    Route::apiResource('/clients', ClientController::class);
    Route::apiResource('/projects', ProjectController::class);
});
