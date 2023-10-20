<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

//cree un lien qui permettra aux clients:React,Vue ect
//recuper la liste des posts

Route::get('posts', [PostController::class, 'index'] );

//ajouter un post /post/put/patch


//inscrire un nouvel utilisateur
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
  //retourner

  Route::put('posts/edit/{post}', [PostController::class, 'update']);
  Route::delete('posts/{post}', [PostController::class, 'delete']);
    Route::post('posts/create', [PostController::class, 'store']); 
    Route:: get('/user' , function(Request $request) {
    return $request->user();
});
});
