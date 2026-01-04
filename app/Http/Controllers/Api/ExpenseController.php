<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::paginate(10);
        if (isEmpty($expenses)) {
            return response()->json([
                'message' => 'Table is empty',
                'data'    => $expenses
            ]);
        }else {
            return response()->json([
                'message'  => 'Data fetched successfully',
                'data'     => $expenses,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'          => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'type'          => 'required|in:fixed,variable',
            'expense_date'  => 'required|date',
            'payment_type'  => 'required|in:cash,bank',
            'frequency'     => 'required_if:type,fixed|in:monthly,yearly',
            'start_date'    => 'required_if:type,fixed|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'note'          => 'nullable|string'
        ]);

        if ($validator['type'] === 'variable') {
            $validator['frequency']  = null;
            $validator['start_date'] = null;
            $validator['end_date']   = null;
        }

        $expense = Expense::create($validator);
        return response()->json([
            'message'  => 'Data created successfully',
            'data'     => $expense,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::findOrFail($id);
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $expense
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = Expense::findOrFail($id);
        $validator = $request->validate([
            'title'          => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'type'          => 'required|in:fixed,variable',
            'expense_date'  => 'required|date',
            'payment_type'  => 'required|in:cash,bank',
            'frequency'     => 'required_if:type,fixed|in:monthly,yearly',
            'start_date'    => 'required_if:type,fixed|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'note'          => 'nullable|string'
        ]);

        if ($validator['type'] === 'variable') {
            $validator['frequency']  = null;
            $validator['start_date'] = null;
            $validator['end_date']   = null;
        }

        $expense->update($validator);
        return response()->json([
            'message'  => 'Data updated successfully',
            'data'     => $expense,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json([
            'message'  => 'Data deleted successfully',
        ]);
    }
}
