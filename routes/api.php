<?php

use App\Domains\User\UserController;
use App\Http\Route;

Route::get("/as/{id}/{username}/{password}", ['', '']);

Route::get('/user', [UserController::class, 'index']);
Route::put('/user', [UserController::class, 'create']);
Route::get('/user/{id}', [UserController::class, 'show']);
