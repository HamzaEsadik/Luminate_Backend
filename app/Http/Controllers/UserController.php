<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user and company
            $user = Auth::user();
            $company = Company::find($user->company_id);
            if ($company == null)
            {
                $comp = 'company';
                $company_id = null;
            }
            else
            {
                $comp = $company->name;
                $company_id = $company->id;
            }
            // Return the name of the authenticated user and company name
            return response()->json([
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'is_manager' => $user->is_manager,
                'company_id' => $company_id,
                'company' => $comp], 200);
        } else {
            // If user is not authenticated, return error
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
}
