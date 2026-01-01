<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'job_title'    => 'required|string|max:255',
            'hire_date'    => 'required|date|before_or_equal:today',
            'phone'        => 'required|string|max:15',
            'emergency_phone' => 'nullable|string|max:15',
            'gender'          => 'nullable|in:male,female',
            'date_of_birth'   => 'nullable|date|before_or_equal:today',
            'national_id'     => 'nullable|string|max:255|unique:employees,national_id',
            'status'          => 'nullable|in:active,inactive',
        ]);

        // check validation
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ]);
        }
        // save employee's information
        $employee = employee::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'job_title'     => $request->job_title,
            'hire_date'     => Carbon::today(),
            'phone'         => $request->phone,
            'emergency_phone' => $request->emergency_phone,
            'gender'          => $request->gender,
            'date_of_birth'   => $request->date_of_birth,
            'national_id'     => $request->national_id,
            'status'          => $request->status,
        ]);
        return response()->json([
            'message'  => 'Date saved successfully',
            'data'     => $employee
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
