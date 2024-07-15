<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\alarmController;
use App\Http\Controllers\reciverController;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('index');
});
Route::get('food_search', [userController::class, 'food_search']);
Route::post('setup', [userController::class, 'setup']);
Route::get('change_status/{id}',[reciverController::class, 'changeStatus']);
Route::get('zero_status/{id}',[alarmController::class, 'zero_status']);


Route::get('on_led_light', [alarmController::class, 'on_led_light']);
