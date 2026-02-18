<?php

use App\Http\Controllers\CodeController;
use Illuminate\Support\Facades\Route;

/**
 * Routes for numeric code management.
 * Separated from web.php to maintain high maintainability.
 */
Route::get('/codes/delete', [CodeController::class, 'deleteForm'])->name('codes.delete_form');
Route::resource('codes', CodeController::class)->only(['index', 'create', 'store', 'destroy']);