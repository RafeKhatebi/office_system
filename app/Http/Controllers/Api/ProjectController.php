<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        if (isEmpty($projects)) {
            return response()->json([
                'message' => 'Table is empty',
                'data' => $projects
            ]);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'message' => 'Not found id: ' . $id,
                'data' => $project
            ], 404);
        }
        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'message' => 'Not found id: ' . $id,
                'data' => $project
            ], 404);
        }

        $project->update($request->validated());
        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'message' => 'Not found id: ' . $id,
                'data' => $project
            ], 404);
        }
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }
}
