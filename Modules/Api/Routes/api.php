<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\ApiController;
use Modules\Api\Http\Controllers\AuthController;

Route::post('/auth', [AuthController::class, 'auth']);

Route::get('sales-opportunities', [ApiController::class, 'salesOpportunities'])->middleware('auth:sanctum');
