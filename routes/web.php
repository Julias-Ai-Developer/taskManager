<?php

use App\Http\Controllers\taskManager\listController;
use App\Http\Controllers\taskManager\TaskController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/lists', [listController::class, 'Index'])->name('lists');
});

require __DIR__ . '/settings.php';
