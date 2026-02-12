<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Public routes and initial redirects.
 * Redirecting root to the main application logic.
 */
Route::get('/', function () {
    return redirect()->route('codes.index');
});

/**
 * Handle default Breeze dashboard redirect.
 * Maps the standard login response to the Codes Manager.
 */
Route::redirect('/dashboard', '/codes')->name('dashboard');

/**
 * Protected routes - accessible only by authenticated users.
 * Implements security layer via 'auth' middleware.
 */
Route::middleware('auth')->group(function () {
    
    // Code Management resource routes
    Route::get('/codes', [CodeController::class, 'index'])->name('codes.index');
    Route::get('/codes/create', [CodeController::class, 'create'])->name('codes.create');
    Route::post('/codes', [CodeController::class, 'store'])->name('codes.store');
    Route::get('/codes/delete', [CodeController::class, 'deleteForm'])->name('codes.delete_form');
    Route::delete('/codes', [CodeController::class, 'destroy'])->name('codes.destroy');

    // User Profile management (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';