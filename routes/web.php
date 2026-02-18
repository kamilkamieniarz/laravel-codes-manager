<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('codes.index');
});

Route::redirect('/dashboard', '/codes')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Modular route files
    require __DIR__ . '/codes.php';
    require __DIR__ . '/profile.php';
});

require __DIR__.'/auth.php';