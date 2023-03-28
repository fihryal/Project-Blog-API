<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;

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

route::middleware(['auth:sanctum'])->group(function(){
    
    route::get('/posts/{id}', [PostController::class ,'show']);
    route::get('/posts/detail/{id}', [PostController::class ,'detail']);
    route::post('/posts',[PostController::class , 'store']);
    route::patch('/posts/{id}',[PostController::class, 'update'])->middleware('post.owner');
    route::delete('/posts/{id}',[PostController::class, 'delete'])->middleware('post.owner');

    route::post('/comment',[CommentController::class, 'store']);
    route::patch('/comment/{id}',[commentController::class, 'update'])->middleware('comment.owner');
    route::delete('/comment/{id}',[commentController::class, 'delete'])->middleware('comment.owner');
    
    route::get('/logout',[AuthenticationController::class, 'logout']);
    route::get('/me',[AuthenticationController::class, 'me']);
});


route::get('/posts', [PostController::class ,'index']);

route::get('search/{title}', [PostController::class,'search']);

route::post('/login', [AuthenticationController::class ,'login']);
route::post('/register',RegisterController::class,'register');