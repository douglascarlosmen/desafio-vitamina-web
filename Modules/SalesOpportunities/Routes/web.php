<?php

use Illuminate\Support\Facades\Route;
use Modules\SalesOpportunities\Http\Controllers\SalesOpportunitiesController;

Route::prefix('oportunidades')->name('sale_opportunity.')->middleware('auth')->group(function() {
    Route::get('/', [SalesOpportunitiesController::class, 'index'])->name('index');
    Route::get('/nova', [SalesOpportunitiesController::class, 'create'])->name('create');
    Route::post('/nova', [SalesOpportunitiesController::class, 'store'])->name('store');
});
