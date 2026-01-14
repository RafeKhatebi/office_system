<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = employee::paginate(10);
        return response()->json([
            'message'  => 'Data fetche successfully',
            'data'     => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        // save employee's information
        $validated['hire_date'] = Carbon::today();
        $employee = employee::create($validated);
        return response()->json([
            'message'  => 'Employee saved successfully',
            'data'     => $employee
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = employee::find($id);
        if (!$employee) {
            return response()->json([
                'message'  => 'Data not found to This id: ' .$id,
                'data'     => $employee

            ], 404);
        }
        return response()->json([
            'message'  => 'Data fetched successfully',
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = employee::find($id);
        if (!$employee) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $employee
            ]);
        }
        $employee->update($request->validated());
        return response()->json([
            'message'  => 'Data updated successfully',
            'data'     => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = employee::find($id);
        if (!$employee) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
            ], 404);
        }

        $employee->delete();
        return response()->json([
            'message'  => 'Data deleted successfully',
        ]);

    }
}
