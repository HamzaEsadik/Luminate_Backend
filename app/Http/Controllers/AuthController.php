<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Login
     */
    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        //Check the user
        $user = User::where('email', $validatedData['email'])->first();
        //Check the password
        if(!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response(['message' => 'wrong email or password'], 401);
        } else {
            $token = $user->createToken('userToken')->plainTextToken;
            return response()
                ->json(['token' => $token], 201);
            }
    }
    /**
     * Logout
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
    }
    /**
     * Register Create new user + company
     */
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'is_manager' => 'required|boolean',
                'name' => $request->input('is_manager') ? 'required|string|max:30' : 'nullable|string|max:30',
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
        $token = $user->createToken('userToken')->plainTextToken;
        return response()
        ->json(['token' => $token], 201);
    }
}
