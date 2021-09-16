<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;


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

Route::group(['middleware'=> ['cors', 'json', 'auth:api']] , function() {
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/all-users-with-role', [UserController::class, 'AllUsersWithRole']);
    Route::post('/compitions', [CompetitionController::class, 'store']);
});

// create compitions 