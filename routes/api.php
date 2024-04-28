<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('/meetings', MeetingController::class);
Route::apiResource('/projects', ProjectController::class);
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/invitations', InvitationController::class);
Route::apiResource('/users', UserController::class);
Route::apiResource('/companies', CompanyController::class);