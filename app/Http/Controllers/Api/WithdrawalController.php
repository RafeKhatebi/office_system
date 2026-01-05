<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdrawals = Withdrawal::with('employee')->paginate(10);
        return response()->json([
            'message'  => 'Data fetched successfully',
            'data'     => $withdrawals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'amount'          => 'required|numeric|min:1',
            'withdrawal_date' => 'required|date',
            'payment_type'    => 'required|in:bank,cash',
            'reason'          => 'nullable|string',
        ]);
        $withdrawal = Withdrawal::create($validator);
        return response()->json([
            'message'  => 'Data saved successfully',
            'data'     => $withdrawal
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withdrawal = Withdrawal::with('employee')->findOrFail($id);
        if (!$withdrawal) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
                'data'     => $withdrawal
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $withdrawal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if (!$withdrawal) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
                'data'     => $withdrawal
            ], 404);
        }
        $validator = $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'amount'          => 'required|numeric|min:1',
            'withdrawal_date' => 'required|date',
            'payment_type'    => 'required|in:bank,cash',
            'reason'          => 'nullable|string',
        ]);

        $withdrawal->update($validator);
        return response()->json([
            'message'  => 'Data updated successfully',
            'data'     => $withdrawal,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if (!$withdrawal) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
            ]);
        }
        $withdrawal->delete();
        return response()->json([
            'message'  => 'Data deleted successfully'
        ]);
    }
}
