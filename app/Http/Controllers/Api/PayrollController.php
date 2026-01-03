<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\Clock\now;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->paginate(10);
        if (isEmpty($payrolls)) {
            return response()->json([
                'massage'  => 'Table is empty',
                'data'     => $payrolls
            ]);
        }
        return response()->json([
            'message'  => 'Data fetched successfully',
            'data'     => $payrolls,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id'      => 'required|integer|exists:employees,id',
            'payroll_month'    => 'required|date_format:Y-m',
            'allowances'       => 'nullable|numeric|min:0',
            'overtime_amount'  => 'nullable|numeric|min:0',
            'deductions'       => 'nullable|numeric|min:0',
            'status'           => 'required|in:paid,pending',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'  => 'Validation error',
                'errors'   => $validator->errors(),
            ]);
        }

        $data = $validator->validated();
        $employee = employee::find($data['employee_id']);

        if (Payroll::where('employee_id', $employee->id)
            ->where('payroll_month', $data['payroll_month'])
            ->exists()
        ) {
            return response()->json([
                'message' => 'Payroll already exists for this employee and month'
            ], 422);
        }

        $basic_salay = $employee->salary;
        $gross = $basic_salay + $data['allowances'] + $data['overtime_amount'];
        $net   = $gross - $data['deductions'];
        $payroll = Payroll::create([
            'employee_id'   => $employee->id,
            'payroll_month' => $request->payroll_month,
            'basic_salary'  => $basic_salay,
            'allowances'    => $request->allowances,
            'overtime_amount' => $request->overtime_amount,
            'gross_salary'    => $gross,
            'deductions'      => $request->deductions,
            'net_salary'      => $net,
            'status'          => $data['status'],
            'paid_at'         => $data['status'] === 'paid' ? now() : null,
        ]);

        return response()->json([
            'message'  => 'Payroll created successfully',
            'data'     => $payroll,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payroll = Payroll::with('employee')->find($id);
        return response()->json([
            'message'  => 'Data fetched successfully',
            'data'     => $payroll
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payroll = Payroll::find($id);
        $validator = Validator::make($request->all(), [
            'employee_id'      => 'required|integer|exists:employees,id',
            'payroll_month'    => 'required|date_format:Y-m',
            'allowances'       => 'nullable|numeric|min:0',
            'overtime_amount'  => 'nullable|numeric|min:0',
            'deductions'       => 'nullable|numeric|min:0',
            'status'           => 'required|in:paid,pending',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'  => 'Validation error',
                'errors'   => $validator->errors(),
            ]);
        }

        $data = $validator->validated();
        $employee = employee::find($data['employee_id']);

        if (Payroll::where('employee_id', $employee->id)
            ->where('payroll_month', $data['payroll_month'])
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return response()->json([
                'message' => 'Payroll already exists for this employee and month'
            ], 422);
        }

        $basic_salay = $employee->salary;
        $gross = $basic_salay + $data['allowances'] + $data['overtime_amount'];
        $net   = $gross - $data['deductions'];

        $payroll->update([
            'employee_id'   => $employee->id,
            'payroll_month' => $request->payroll_month,
            'basic_salary'  => $basic_salay,
            'allowances'    => $request->allowances,
            'overtime_amount' => $request->overtime_amount,
            'gross_salary'    => $gross,
            'deductions'      => $request->deductions,
            'net_salary'      => $net,
            'status'          => $data['status'],
            'paid_at'         => $data['status'] === 'paid' ? now() : null,
        ]);

        return response()->json([
            'message'  => 'Payroll updated successfully',
            'data'     => $payroll,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payroll = Payroll::find($id);
        $payroll->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ]);
    }
}
