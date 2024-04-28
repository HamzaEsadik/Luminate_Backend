<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'is_manager' => 'required|boolean',
                'name' => 'string|max:30',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        
        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->is_manager = $validatedData['is_manager'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        if ($request['name'])
        {
            $company = new Company();
            $company->name = $validatedData['name'];
            $company->save();
            $user->company_id = $company->id;
        }
        $user->save();
        //$token = $request->user()->createToken($request->token_name);
        return response()
        ->json(['message' => 'user created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
