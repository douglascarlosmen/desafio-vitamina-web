<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\ApiController;

Route::post('/auth', [ApiController::class, 'auth']);
