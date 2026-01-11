<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
        if (isEmpty($clients)) {
            return response()->json([
                'message' => 'Table is empty',
                'data'    => $clients
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $clients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        return response()->json([
            'message' => 'Client created successfully',
            'data'    => $client,        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $client
            ], 404);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data'    => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $client,
            ], 404);
        }

        $client->update($request->validated());
        return response()->json([
            'message' => 'Client updated successfully',
            'data'    => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'message' => 'Not found id: '.$id,
                'data'    => $client,
            ], 404);
        }

        $client->delete();
        return response()->json([
            'message' => 'Client deleted successfully',
        ]);
    }
}
