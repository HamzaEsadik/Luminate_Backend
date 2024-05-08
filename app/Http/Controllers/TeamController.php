<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display the team
     */
    public function team()
    {
        $user = Auth::user();
        $companyId = $user->company_id;
        if ($companyId) {
            return User::where('company_id', $companyId)->get();
        }
    }
}
