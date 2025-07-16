<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::put('{user}', [UserController::class, 'update']);
});

Route::prefix('money')->group(function () {
    Route::post('deposit/user/{user}', DepositController::class);
    Route::post('transfer', TransferController::class);
});
