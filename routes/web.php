<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard', [AdminController::class,'index'])->middleware(['auth', 'admin', 'verified'])->name('admin/dashboard');

route::get('superadmin/dashboard', [SuperAdminController::class,'index'])->middleware(['auth', 'superadmin', 'verified'])-> name('superadmin/dashboard');

route::put('superadmin/update/{id}', [SuperAdminController::class, 'update'])->middleware(['auth', 'superadmin', 'verified'])->name('superadmin/update');

route::get('superadmin/delete/{id}', [SuperAdminController::class, 'destroy'])->middleware(['auth', 'superadmin','verified'])->name('superadmin/delete');

route::post('createappointment', [UserController::class, 'store'])->name('createappointment')->middleware(['auth', 'verified', 'user']);

route::get('checkstatus', [UserController::class, 'get'])->name('checkstatus')->middleware(['auth', 'verified', 'user']);

route::put('admin/update/{id}', [AdminController::class, 'update'])->name('admin/update')->middleware('admin', 'auth', 'verified');

route::get('checkstatus/delete/{id}', [UserController::class, 'destroy'])->name('checkstatus/delete')->middleware(['auth', 'verified', 'user']);

Route::get('testmail', [UserController::class, 'sendAppointmentEmail'])->name('testmail');