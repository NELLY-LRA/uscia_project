<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuperAdmin\NationalAdminController;
use App\Http\Controllers\SuperAdmin\RoleChangeController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/accueil', function () {
    return view('accueil');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return redirect('/redirect');
})->name('dashboard');

Route::get('/redirect', function () {
    if (Auth::user()->role === 'super-admin') {
        return redirect('/super-admin/dashboard');
    } elseif (Auth::user()->role === 'national-admin') {
        return redirect('/national-admin/dashboard');
    } else {
        abort(403); // interdit pour les autres
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('/super-admin/dashboard', function () {
        return view('super-admin.dashboard');
    })->name('super.dashboard');
});




Route::get('/liste_m', function () {
    return view('super-admin.liste_m');
})->name('liste_m');

Route::get('/membre', function () {
    return view('super-admin.membre');
})->name('membre');

Route::get('/pays', function () {
    return view('super-admin.pays');
})->name('pays');


Route::middleware(['auth'])->prefix('super-admin')->group(function () {
    Route::get('/super-admin/list_a', [NationalAdminController::class, 'admin_list'])->name('national-admin.index');
    Route::get('/super-admin/admins/create', [NationalAdminController::class, 'create'])->name('national-admin.create');
Route::post('/super-admin/admins', [NationalAdminController::class, 'store'])->name('national-admin.store');
Route::get('/super-admin/admins/{id}/edit', [NationalAdminController::class, 'edit'])->name('national-admin.edit');
Route::put('/super-admin/admins/{id}', [NationalAdminController::class, 'update'])->name('national-admin.update');
Route::delete('/super-admin/admins/{id}', [NationalAdminController::class, 'destroy'])->name('national-admin.destroy');

});

 //profile*/
    Route::prefix('profile')->group(function(){
        Route::get('detail', [ProfileController::class, 'profileDetails'])->name('profileDetails');
        Route::post('update', [ProfileController::class, 'update'])->name('adminProfileUpdate');
        Route::get('account/{id}', [ProfileController::class, 'accountProfile'])->name('accountProfile');


        Route::get('create/adminAccount', [ProfileController::class, 'createAdminAccount'])->name('add_admin');
        Route::post('create/adminAccount', [ProfileController::class, 'create'])->name('createAdmin');
    });


    Route::prefix('role')->group(function(){
        Route::get('list',[RoleChangeController::class, 'adminList'])->name('adminList');
        Route::get('deleteAdminAccount/{id}',[RoleChangeController::class, 'deleteAdminAccount'])->name('deleteAdminAccount');
        Route::get('changeUserRole/{id}',[RoleChangeController::class, 'changeUserRole'])->name('changeUserRole');

        Route::get('userList',[RoleChangeController::class, 'userList'])->name('userList');
        Route::get('deleteUserAccount/{id}',[RoleChangeController::class, 'deleteUserAccount'])->name('deleteUserAccount');
        Route::get('changeAdminRole/{id}',[RoleChangeController::class, 'changeAdminRole'])->name('changeAdminRole');

    });
