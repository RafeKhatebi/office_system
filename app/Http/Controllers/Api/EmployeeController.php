<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;
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
            'status'          => 'nullable|in:active,inactive,terminated',
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
