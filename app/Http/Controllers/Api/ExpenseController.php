<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
    /*Display a listing of the resource.*/
    public function index(): JsonResponse
    {
        $expenses = Expense::paginate(10);

        if ($expenses->isEmpty()) {
            return response()->json([
                'message' => 'Table is empty',
                'data' => $expenses,
            ]);
        }

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $expenses,
        ]);
    }

    /*Store a newly created resource in storage.*/
    public function store(ExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create($request->validated());

        return response()->json([
            'message' => 'Data created successfully',
            'data' => $expense,
        ], 201);
    }

    /* Display the specified resource.*/
    public function show(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $expense,
        ]);
    }

    /* Update the specified resource in storage.*/
    public function update(ExpenseRequest $request, string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $expense->update($request->validated());

        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $expense,
        ]);
    }

    /* Remove the specified resource from storage.*/
    public function destroy(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return response()->json([
            'message' => 'Data deleted successfully',
        ]);
    }
}
