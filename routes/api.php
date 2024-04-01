<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CongesController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SanctionController;
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

Route::middleware('auth:sanctum')->get('/getuser', function (Request $request) {
    return response()->json(['user'=>$request->user()]) ;
});

Route::post('/auth/register', [AuthController::class, 'createUser']) ;
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('login');
Route::get('/auth/logout', [AuthController::class, 'logoutUser'])->name('logout');

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('/user' , UserController::class) ; 
    Route::resource('/sanction' , SanctionController::class) ; 
    Route::resource('/presence' , PresenceController::class) ; 
    Route::resource('/conge' , CongesController::class) ; 
}) ;