<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryContronller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * UserProfil
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});



/**
 * Category
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'category'
], function ($router) {
    Route::get('/selectCategory', [CategoryContronller::class, 'selecteCategory']);
    Route::post('/insertCategory', [CategoryContronller::class, 'insertCategory']);
    Route::put('/updateCategory/{id}', [CategoryContronller::class, 'updateCategory']);
});


/**
 * Media
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'media'
], function ($route) {
    Route::get('/{path}/original/{filename}', [MediaController::class, 'getMedia']);
});


/**
 * Menu
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'menu'
], function ($route) {
    Route::get('/selectMenu', [MenuController::class, 'selectMenu']);
    Route::post('/insertMenu', [MenuController::class, 'insertMenu']);
});
