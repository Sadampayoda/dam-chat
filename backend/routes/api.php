<?php

use App\Http\Controllers\Api\{UserController,ProfileController};
use App\Http\Controllers\AuthenticationController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tes-auth', function (Request $request) {
    return $request->user();
})->middleware(middleware: 'auth:sanctum');

Route::get('/tes-doang',function(){
    $model = Model::all();
    return $model;
});

Route::get('users/where',[UserController::class,'where'])->name('users.where');
Route::apiResource('users',UserController::class)->names('users');
Route::post('auth',AuthenticationController::class)->name('auth');


Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource('profile',ProfileController::class)->except(['index','create','edit']);
});



