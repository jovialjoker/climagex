<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;

Route::middleware('auth')->group(function () {
    Route::get('/organizations', [OrganizationController::class, 'index'])
        ->middleware('admin')
        ->name('organizations.index');

    Route::get('/organizations/{organization}', [OrganizationController::class, 'edit'])
        ->middleware('admin')
        ->name('organizations.edit');

    Route::post('/organizations', [OrganizationController::class, 'store'])
        ->middleware('admin')
        ->name('organizations.store');

    Route::patch('/organizations/{organization}', [OrganizationController::class, 'update'])
        ->middleware('admin')
        ->name('organizations.update');

    Route::delete('/organizations/{organization}', [OrganizationController::class, 'delete'])
        ->middleware('admin')
        ->name('organizations.delete');
});
