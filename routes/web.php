<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\alarmController;
use App\Http\Controllers\reciverController;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('index');
});
Route::get('food_search', [UserController::class, 'food_search']);
Route::post('setup', [UserController::class, 'setup']);
Route::get('change_status/{id}',[reciverController::class, 'changeStatus']);
Route::get('zero_status/{id}',[alarmController::class, 'zero_status']);
