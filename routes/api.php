<?php

use App\Domains\HomePage\HomePageController;
use App\Http\Route;

Route::get('/user', [HomePageController::class, 'index']);
Route::get('/user/{id}', [HomePageController::class, 'show']);
