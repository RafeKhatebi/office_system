<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeSourceRequest;
use App\Models\IncomeResource;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class IncomeResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomeResources = IncomeResource::all();
        if (isEmpty($incomeResources)) {
            return response()->json([
                'message' => 'Table is empty',
                'data'    => $incomeResources
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $incomeResources
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeSourceRequest $request)
    {
        $incomeResource = IncomeResource::create($request->validated());
        return response()->json([
            'message'  => 'Data inserted successfully',
            'data'     => $incomeResource
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incomeResource = IncomeResource::find($id);
        if (!$incomeResource) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
                'data'     => $incomeResource
            ], 404);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $incomeResource
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomeSourceRequest $request, string $id)
    {
        $incomeResource = IncomeResource::find($id);
          if (!$incomeResource) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
                'data'     => $incomeResource
            ], 404);
        }

        $incomeResource->update($request->validated());
        return response()->json([
            'message' => 'Data updated successfully',
            'data'    => $incomeResource
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incomeResource = IncomeResource::find($id);
          if (!$incomeResource) {
            return response()->json([
                'message'  => 'Not found id: '.$id,
                'data'     => $incomeResource
            ], 404);
        }

        $incomeResource->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ]);
    }
}
