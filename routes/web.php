<?php

use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/user-preferences/create', [UserPreferenceController::class, 'create'])->name('user-preferences.create');
    Route::post('/user-preferences', [UserPreferenceController::class, 'store'])->name('user-preferences.store');
});
