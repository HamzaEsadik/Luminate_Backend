<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvitationResource;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return InvitationResource::collection(Invitation::where('user_id', $user->id)->get());
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
                //validate invitation data to store
                try {
                    $validatedData = $request->validate([
                        'user_id' => 'required|unique:invitations,user_id',
                        'company_id' => 'required',
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(['errors' => $e->errors()], 422);
                }
                $invitation = new Invitation();
                $invitation->user_id = $validatedData['user_id'];
                $invitation->company_id = $validatedData['company_id'];
                $invitation->save();
                return response()
                ->json(['message' => 'Invitation sent successfully'], 201);
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
    public function destroy(Invitation $invitation)
    {
        $user = Auth::user();
        Invitation::where('id', $invitation->id)->delete();
        return response()
                ->json(['message' => 'invitation removed'], 201);
    }

    /**
     * Accepted invite - add company_id to user
     */
    public function accepted()
    {
        // Get the authenticated user and company
        $authUser = Auth::user();
        $user = User::find($authUser->id);
        $invitation = Invitation::where('user_id', $authUser->id)->first();
        $user->company_id = $invitation->company_id;
        $user->save();
    }

    /**
     * firing User from company
     */
    public function firing(Request $request)
    {
        // Get the authenticated user and company
        $authUser = Auth::user();
        $user_id = $request->query('user_id');
        $user = User::find($user_id);
        $user->company_id = NULL;
        $user->save();
    }

}
