<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    Route::post('/login', [ApiAuthController::class, "login"] )->name('login.api');
    Route::post('/register',[ApiAuthController::class,'register'])->name('register.api');
    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');
});

Route::middleware('auth:api')->get('/test',function() {
    return "test";
});
Route::group(['middleware'=> ['cors', 'json', 'auth:api']] , function() {
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/all-users-with-role', [UserController::class, 'AllUsersWithRole']);
});
