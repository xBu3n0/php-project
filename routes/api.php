<?php

use App\Domains\User\UserController;
use App\Domains\User\UserMiddleware;
use App\Http\Route;

Route::get("/as/{id}/{username}/{password}", ['', '']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users/validate', [UserController::class, 'validateLogin'])->middleware(UserMiddleware::class);
