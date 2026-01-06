<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use App\Models\income;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        $incomes = income::with('source')->paginate(10);
        if ($incomes->isEmpty()) {
=======
        $incomes = income::paginate(10);
        if (isEmpty($incomes)) {
>>>>>>> Stashed changes
=======
        $incomes = income::paginate(10);
        if (isEmpty($incomes)) {
>>>>>>> Stashed changes
            return response()->json([
                'message' => 'Table is empty',
                'data'    => $incomes
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $incomes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request)
    {
        $income = income::create($request->validated());
        return response()->json([
            'message' => 'Data inserted successfully',
            'data'    => $income
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        $income = income::with('source')->find($id);
=======
        $income = income::find($id);
>>>>>>> Stashed changes
=======
        $income = income::find($id);
>>>>>>> Stashed changes
        if (!$income) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $income
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $income
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $income = income::find($id);
        if (!$income) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $income
            ]);
        }
        $income->update($request->validated());
        return response()->json([
            'message' => 'Data updated successfully',
            'data'    => $income
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $income = income::find($id);
        if (!$income) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $income
            ]);
        }
        $income->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ]);
    }
}
