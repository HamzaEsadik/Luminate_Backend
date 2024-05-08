<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $projectId = $request->query('project_id');
        return TaskResource::collection(Task::where('user_id', $user->id)
        ->where('project_id', $projectId)
        ->get());
    }

    /**
     * Display a listing of the resource.
     */
    public function getTasks(Request $request)
    {
        $user = Auth::user();
        $userId = $request->query('user_id');
        $projectId = $request->query('project_id');
        return TaskResource::collection(Task::where('user_id', $userId)
        ->where('project_id', $projectId)
        ->get());
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
                //validate task data to store
                try {
                    $validatedData = $request->validate([
                        'title' => 'required|string|max:100',
                        'description' => 'required|string|max:2000',
                        'start_at' => 'required|date|after:today',
                        'ends_at' => 'required|date|after:start_at',
                        'user_id' => 'required',
                        'project_id' => 'required',
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(['errors' => $e->errors()], 422);
                }
                $task = new Task();
                $task->title = $validatedData['title'];
                $task->description = $validatedData['description'];
                $task->start_at = $validatedData['start_at'];
                $task->ends_at = $validatedData['ends_at'];
                $task->user_id = $validatedData['user_id'];
                $task->project_id = $validatedData['project_id'];
                $task->save();
                return response()
                ->json(['message' => 'Task created successfully'], 201);
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
        try {
            $validatedData = $request->validate([
                
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();
        Task::where('id', $task->id)->delete();
        return response()
                ->json(['message' => 'task deleted'], 201);
    }
}
