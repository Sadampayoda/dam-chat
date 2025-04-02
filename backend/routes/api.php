<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware(middleware: 'auth:sanctum');


Route::get('users/where',[UserController::class,'where'])->name('users.where');
Route::post('users/auth',[UserController::class,'auth'])->name('users.auth');
Route::apiResource('users',UserController::class)->names('users');

