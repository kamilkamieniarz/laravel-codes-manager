<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('codes.index');
});

Route::redirect('/dashboard', '/codes')->name('dashboard');

/**
 * Protected routes requiring authentication.
 * Utilizing Route::resource and controller grouping to strictly adhere to the DRY principle.
 */
Route::middleware(['auth'])->group(function () {
    
    // Custom route must be defined BEFORE the resource to avoid matching conflicts
    Route::get('/codes/delete', [CodeController::class, 'deleteForm'])->name('codes.delete_form');

    // Standard CRUD operations for codes mapped cleanly to the controller
    Route::resource('codes', CodeController::class)->only(['index', 'create', 'store', 'destroy']);

    // User Profile Management - grouped by controller, prefix, and name to avoid repetition
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

});

require __DIR__.'/auth.php';