<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->company_id;
        return ProjectResource::collection(Project::where('company_id', $companyId)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();
            if ($user->is_manager)
            {
                //validate project data to store
                try {
                    $validatedData = $request->validate([
                        'title' => 'required|string|max:100',
                        'description' => 'required|string|max:2000',
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(['errors' => $e->errors()], 422);
                }
                $project = new Project();
                $project->title = $validatedData['title'];
                $project->description = $validatedData['description'];
                $project->company_id = $user->company_id;
                $project->save();
                return response()
                ->json(['message' => 'project created successfully'], 201);
            }
            else
            {
                return response()
                ->json(['message' => 'you are not a manager'], 401);
            }
        } else {
            // If user is not authenticated, return error
            return response()
            ->json(['error' => 'Unauthenticated'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $user = Auth::user();
        Project::where('id', $project->id)->delete();
        return response()
                ->json(['message' => 'project deleted'], 201);
    }
}
