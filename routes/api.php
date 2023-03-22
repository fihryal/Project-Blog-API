<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;

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

route::get('/posts', [PostController::class ,'index']);
route::get('/posts/{id}', [PostController::class ,'show'])->middleware(['auth:sanctum']);
route::get('/posts/detail/{id}', [PostController::class ,'detail'])->middleware(['auth:sanctum']);

route::post('/login', [AuthenticationController::class ,'login']);
route::get('/logout',[AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);