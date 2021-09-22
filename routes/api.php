<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ClubController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');
});
Route::group(['middleware' => ['cors', 'json']], function () {
    Route::post('/login', [ApiAuthController::class, "login"] );
    Route::post('/register',[ApiAuthController::class,'register']);
});
Route::middleware('auth:api')->post('/logout', [ApiAuthController::class,'logout']);

Route::group(['middleware'=> ['cors', 'json', 'auth:api', 'role:superadministrator']] , function() {
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/all-users-with-role', [UserController::class, 'AllUsersWithRole']);
    Route::get('/users', [UserController::class, 'getAllUsers']);

    //competitions resource
    Route::group(['prefix'=>'competitions'], function() {
        Route::post('/', [CompetitionController::class, 'store']);
        Route::get('/{id}', [CompetitionController::class, 'show']);
        Route::post('/{id}/update', [CompetitionController::class, 'update']);
        Route::delete('/{id}/delete', [CompetitionController::class, 'delete']);
    });
});


//teams resource
Route::group(['prefix'=>'clubs' ,'middleware'=> ['cors', 'json', 'auth:api', 'auth:api','role:superadministrator|administrator']], function() {
    Route::post('/', [ClubController::class, 'store']);
    Route::get('/', [ClubController::class, 'getAll']);
    Route::post('/members', [ClubController::class, 'addMembers']);
    Route::get('/{id}', [ClubController::class, 'show'])->middleware('role:superadministrator|administrator|user');
    Route::post('/{id}/update', [ClubController::class, 'update']);
    Route::delete('/{id}/delete', [ClubController::class, 'delete']);
    Route::get('users/{id}', [UserController::class, 'getAllUsersByClub']);
    Route::get('competitions/{id}', [ClubController::class, 'getCompetitionClubs']);
});

Route::middleware('auth:api')->get('user/{id}',[UserController::class, 'getUser']);
Route::group(['middleware'=> ['cors', 'json', 'auth:api']] , function() {
    Route::get('/competitions', [CompetitionController::class, 'index']);
});
