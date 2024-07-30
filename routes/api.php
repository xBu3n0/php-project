<?php

use App\Domains\User\UserController;
use App\Http\Route;

Route::get("/as/{id}/{username}/{password}", ['', '']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'create']);
Route::get('/users/{id}', [UserController::class, 'show']);
