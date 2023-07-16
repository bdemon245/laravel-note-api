<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\TagController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\NoteController;

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

//?api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function () {
    Route::apiResource('/notes', NoteController::class);
    Route::apiResource('/tags', TagController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

//user
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
