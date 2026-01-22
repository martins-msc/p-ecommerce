<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth','verified']);
Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting.index')->middleware(['auth','verified']);
Route::post('/admin/setting', [SettingController::class, 'store'])->name('admin.setting.store')->middleware(['auth', 'verified']);

//roles
Route::get('/admin/roles', [RolesController::class, 'index'])->name('admin.roles.index')->middleware(['auth','verified']);
Route::get('/admin/roles/create', [RolesController::class, 'create'])->name('admin.roles.create')->middleware(['auth', 'verified']);
Route::post('/admin/roles', [RolesController::class, 'store'])->name('admin.roles.store')->middleware(['auth','verified']);
Route::get('/admin/rol/{id}', [RolesController::class, 'show'])->name('admin.roles.show')->middleware(['auth','verified']);
Route::get('/admin/rol/{id}/edit', [RolesController::class, 'edit'])->name('admin.roles.edit')->middleware(['auth','verified']);
Route::put('/admin/rol/{id}', [RolesController::class, 'update'])->name('admin.roles.update')->middleware(['auth','verified']);
Route::delete('/admin/rol/{id}', [RolesController::class, 'destroy'])->name('admin.roles.destroy')->middleware(['auth','verified']);

//user
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index')->middleware(['auth','verified']);
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create')->middleware(['auth', 'verified']);
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store')->middleware(['auth','verified']);
Route::get('/admin/user/{id}', [UserController::class, 'show'])->name('admin.users.show')->middleware(['auth','verified']);
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit')->middleware(['auth','verified']);
Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.users.update')->middleware(['auth','verified']);
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware(['auth','verified']);
Route::post('/admin/user/{id}/restore', [UserController::class, 'restore'])->name('admin.users.restore')->middleware(['auth', 'verified']);
//category
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index')->middleware(['auth','verified']);
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create')->middleware(['auth', 'verified']);
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store')->middleware(['auth','verified']);
Route::get('/admin/category/{id}', [CategoryController::class, 'show'])->name('admin.categories.show')->middleware(['auth','verified']);
Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit')->middleware(['auth','verified']);
Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('admin.categories.update')->middleware(['auth','verified']);
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy')->middleware(['auth','verified']);
//products
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index')->middleware(['auth','verified']);
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create')->middleware(['auth', 'verified']);
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store')->middleware(['auth','verified']);
Route::get('/admin/product/{id}', [ProductController::class, 'show'])->name('admin.products.show')->middleware(['auth','verified']);
Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit')->middleware(['auth','verified']);
Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('admin.products.update')->middleware(['auth','verified']);
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy')->middleware(['auth','verified']);


require __DIR__.'/auth.php';
