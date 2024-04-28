<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeetingResource;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MeetingResource::collection(Meeting::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:100',
                'datetime' => 'required',
                'company_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $meeting = new Meeting();
        $meeting->title = $validatedData['title'];
        $meeting->datetime = $validatedData['datetime'];
        $meeting->company_id = $validatedData['company_id'];
        $meeting->save();
        return response()
        ->json(['message' => 'meeting created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
