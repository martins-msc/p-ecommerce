<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth','verified']);
Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting.index')->middleware(['auth','verified']);
Route::post('/admin/setting', [SettingController::class, 'store'])->name('admin.setting.store')->middleware(['auth', 'verified']);

Route::get('/admin/roles', [RolesController::class, 'index'])->name('admin.roles.index')->middleware(['auth','verified']);
Route::get('/admin/roles/create', [RolesController::class, 'create'])->name('admin.roles.create')->middleware(['auth', 'verified']);
Route::post('/admin/roles', [RolesController::class, 'store'])->name('admin.roles.store')->middleware(['auth','verified']);
Route::get('/admin/rol/{id}', [RolesController::class, 'show'])->name('admin.roles.show')->middleware(['auth','verified']);
Route::get('/admin/rol/{id}/edit', [RolesController::class, 'edit'])->name('admin.roles.edit')->middleware(['auth','verified']);
Route::put('/admin/rol/{id}', [RolesController::class, 'update'])->name('admin.roles.update')->middleware(['auth','verified']);
Route::delete('/admin/rol/{id}', [RolesController::class, 'destroy'])->name('admin.roles.destroy')->middleware(['auth','verified']);

require __DIR__.'/auth.php';
