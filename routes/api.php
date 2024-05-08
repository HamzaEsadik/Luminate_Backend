<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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
//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);
//auth group route
Route::group(['middleware' => ['auth:sanctum']], function() {
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
    //return user login
    Route::apiResource('/users', UserController::class);
    //Meeting POST-GET-DELET
    Route::apiResource('/meetings', MeetingController::class);
    //Projects POST-GET-DELET
    Route::apiResource('/projects', ProjectController::class);
    //Task POST-GET-DELET
    Route::apiResource('/tasks', TaskController::class);
    //Invitation POST-GET-DELET
    Route::apiResource('/invitations', InvitationController::class);
    //Accept Invitation
    Route::put('/accept', [InvitationController::class, 'accepted']);
    //Firing User
    Route::put('/firing', [InvitationController::class, 'firing']);
    //team
    Route::get('/team', [TeamController::class, 'team']);
    //taskfor
    Route::get('/tasksfor', [TaskController::class, 'getTasks']);
});
