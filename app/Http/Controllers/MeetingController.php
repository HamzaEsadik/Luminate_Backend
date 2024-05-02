<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeetingResource;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->company_id;
        return MeetingResource::collection(Meeting::where('company_id', $companyId)->get());
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
                //validate meeting data to store
                try {
                    $validatedData = $request->validate([
                        'title' => 'required|string|max:100',
                        'datetime' => 'required',
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(['errors' => $e->errors()], 422);
                }
                $meeting = new Meeting();
                $meeting->title = $validatedData['title'];
                $meeting->datetime = $validatedData['datetime'];
                $meeting->company_id = $user->company_id;
                $meeting->save();
                return response()
                ->json(['message' => 'meeting created successfully'], 201);
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
    public function destroy(Meeting $meeting)
    {
        $user = Auth::user();
        Meeting::where('id', $meeting->id)->delete();
        return response()
                ->json(['message' => 'meeting deleted'], 201);
    }
}
