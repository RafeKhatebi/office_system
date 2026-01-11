<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\FinancialReport;
use App\Models\income;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;

class FinancialReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financials = FinancialReport::paginate(10);
        if (isEmpty($financials)) {
            return response()->json([
                'massage' => 'Tabel is empty',
                'data' => $financials,
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $financials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function financialSummary(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $from_date = Carbon::parse($request->from);
        $to_date = Carbon::parse($request->to);

        $total_income = income::whereBetween('income_date', [$from_date, $to_date])->sum('amount');
        $total_expense = Expense::whereBetween('expense_date', [$from_date, $to_date])->sum('amount');
        $total_withdrawal = Withdrawal::whereBetween('withdrawal_date', [$from_date, $to_date])->sum('amount');
        $net_result = $total_income - ($total_expense + $total_withdrawal);

        $report = FinancialReport::create([
            'report_type' => 'financial_summary',
            'from' => $from_date,
            'to' => $to_date,
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'total_withdrawal' => $total_withdrawal,
            'net_result' => $net_result
        ]);

        return response()->json([
            'message' => 'Financial created successfully',
            'data' => $report
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
