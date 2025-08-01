<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuperAdmin\NationalAdminController;
use App\Http\Controllers\SuperAdmin\RoleChangeController;
use Illuminate\Support\Facades\Password;




Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/missions-vision', function () {
    return view('missions-vision');
})->name('missions');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/our-social-works', function () {
    return view('our-social-works');
})->name('social-works');


Route::get('/trainings', function () {
    return view('trainings-uscia-africa');
})->name('trainings');



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
         Route::get('edit/{id}', [ProfileController::class, 'editAdmin'])->name('editAdmin');
        Route::post('update/{id}', [ProfileController::class, 'updateAdmin'])->name('updateAdmin');
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
Route::get('edit/{id}', [RoleChangeController::class, 'editUser'])->name('editUser');
Route::post('update/{id}', [RoleChangeController::class, 'updateUser'])->name('updateUser');
    });

//Forgot
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
