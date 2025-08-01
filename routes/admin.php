<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AdminController;

/*admin
Route::group(['prefix' => 'admin' , 'middleware' => ['auth','admin']], function(){
    Route::get('/home', [AdminDashboardController::class, 'index'])->name('adminDashboard');


    });


    //password
    Route::prefix('password')->group(function(){
        Route::get('change', [AuthController::class, 'changePasswordPage'])->name('passwordChange');
        Route::post('change', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::get('reset', [AuthController::class, 'resetPasswordPage'])->name('resetPasswordPage');
        Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

    });


    /*role
    Route::prefix('role')->group(function(){
        Route::get('list',[RoleChangeController::class, 'adminList'])->name('adminList');
        Route::get('deleteAdminAccount/{id}',[RoleChangeController::class, 'deleteAdminAccount'])->name('deleteAdminAccount');
        Route::get('changeUserRole/{id}',[RoleChangeController::class, 'changeUserRole'])->name('changeUserRole');

        Route::get('userList',[RoleChangeController::class, 'userList'])->name('userList');
        Route::get('deleteUserAccount/{id}',[RoleChangeController::class, 'deleteUserAccount'])->name('deleteUserAccount');
        Route::get('changeAdminRole/{id}',[RoleChangeController::class, 'changeAdminRole'])->name('changeAdminRole');

    });*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/{country}/dashboard', function ($country) {
        $user = Auth::user();

        if ($user->role !== 'admin') abort(403);

        if (strtolower($user->country->name) !== strtolower($country)) {
            abort(403, 'Vous ne pouvez pas accéder au dashboard d’un autre pays');
        }

        return view("admin.dashboards.$country"); // Exemple : admin/dashboards/cameroun.blade.php
    })->name('admin.dashboard');
});
