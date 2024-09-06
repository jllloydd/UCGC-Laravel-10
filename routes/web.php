<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/admin/counselor-profile/update', [AdminController::class, 'updateCounselorProfile'])->name('admin.counselor.profile.update');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__.'/auth.php';

route::get('admin/dashboard', [AdminController::class,'index'])->middleware(['auth', 'admin', 'verified'])->name('admin/dashboard');

route::get('admin/counselorlist', [AdminController::class,'counselorlist'])->middleware(['auth', 'admin', 'verified'])->name('admin/counselorlist');

route::get('superadmin/dashboard', [SuperAdminController::class,'index'])->middleware(['auth', 'superadmin', 'verified'])-> name('superadmin/dashboard');

route::put('superadmin/update/{id}', [SuperAdminController::class, 'update'])->middleware(['auth', 'superadmin', 'verified'])->name('superadmin/update');

route::get('superadmin/delete/{id}', [SuperAdminController::class, 'destroy'])->middleware(['auth', 'superadmin','verified'])->name('superadmin/delete');

route::post('createappointment', [UserController::class, 'store'])->name('createappointment')->middleware(['auth', 'verified', 'user']);

route::get('checkstatus', [UserController::class, 'get'])->name('checkstatus')->middleware(['auth', 'verified', 'user']);

route::put('admin/update/{id}', [AdminController::class, 'update'])->name('admin/update')->middleware('admin', 'auth', 'verified');

route::get('checkstatus/delete/{id}', [UserController::class, 'destroy'])->name('checkstatus/delete')->middleware(['auth', 'verified', 'user']);

Route::get('admin/panel', [AdminController::class, 'panel'])->name('admin/panel')->middleware('auth', 'verified', 'admin');

route::put('admin/panel/edit/{id}', [AdminController::class, 'editappdeets'])->name('admin/panel/edit')->middleware(['auth', 'verified', 'admin']);

Route::put('admin/panel/complete/{id}', [AdminController::class, 'setAsComplete'])->name('admin/panel/complete')->middleware(['auth', 'verified', 'admin']);