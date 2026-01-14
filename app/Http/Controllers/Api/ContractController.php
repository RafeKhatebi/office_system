<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('project')->paginate(10);
        if (isEmpty($contracts)) {
            return response()->json([
                'message' => 'Table is empty',
                'data'    => $contracts
            ]);
        }
        return response()->json([
            'message' => 'Data fetched',
            'data'    => $contracts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('contract_file')) {
            $data['contract_file'] = $request->file('contract_file')->store('contracts', 'public');
        }
        $contract = Contract::create($data);
        return response()->json([
            'message' => 'Contract created successfully',
            'data'    => $contract
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract = Contract::with('project')->find($id);
        if (!$contract) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $contract
            ], 404);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContractRequest $request, Contract $contract)
    {
        $data = $request->validated();
        if ($request->hasFile('contract_file')) {
            if ($contract->contract_file) {
                Storage::disk('public')->delete($contract->contract_file);
            }

            $data['contract_file'] = $request->file('contract_file')->store('contracts', 'public');
        }
        $contract->update($data);
        return response()->json([
            'message' => 'Contract updated successfully',
            'data'    => $contract
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        if ($contract->contract_file) {
            Storage::disk('public')->delete($contract->contract_file);
        }
        $contract->delete();
        return response()->json([
            'message' => 'Centract deleted successfully',
        ]);
    }
}
