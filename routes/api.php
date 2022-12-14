<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
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
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
Route::prefix('rol')->middleware(['api'])->group(function ($router) {
    Route::resource('roles', RolController::class);
});
Route::prefix('user')->middleware(['api'])->group(function ($router) {
    Route::resource('users', UserController::class);
    Route::put('/upPass/{id}',[UserController::class,'updatePassword']);
    Route::get('/rolUser/{id}',[UserController::class,'getUserByRol']);
});
Route::prefix('category')->middleware(['api'])->group(function ($router) {
    Route::resource('categorys', CategoryController::class);
});
