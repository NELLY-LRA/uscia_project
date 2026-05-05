<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;

// Route de connexion (publique)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// routes/web.php
Route::get('/inscription', [MemberController::class, 'create'])->name('member.create');
Route::post('/inscription', [MemberController::class, 'store'])->name('member.store');

// Routes protégées (nécessitent d'être connecté)
Route::middleware(['auth'])->group(function () {
    // Redirection après connexion selon le rôle
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard par rôle (on les créera plus tard)
    Route::get('/dashboard/super-admin', [DashboardController::class, 'superAdmin'])->name('dashboard.super-admin');
 Route::get('/dashboard/national', [DashboardController::class, 'national'])->name('dashboard.national');
    Route::get('/dashboard/regional', [DashboardController::class, 'regional'])->name('dashboard.regional');
});

// Redirection de la racine vers login si non connecté
Route::redirect('/', '/login');


// ===== ROUTES PROTÉGÉES =====
Route::middleware(['auth'])->group(function () {
    // ... le reste du code
});

Route::middleware(['auth'])->group(function () {
    // ... routes existantes

    // Routes pour les membres
    Route::get('/membres/{id}', [DashboardController::class, 'showMember'])->name('members.show');
});

Route::middleware(['auth'])->group(function () {
    // ... routes existantes

    // Gestion des administrateurs
    Route::prefix('admins')->group(function () {
        // Super Admin : gestion des admins nationaux
        Route::get('/nationaux', [AdminController::class, 'nationalIndex'])->name('admins.national.index');
        Route::get('/nationaux/create', [AdminController::class, 'nationalCreate'])->name('admins.national.create');
        Route::post('/nationaux', [AdminController::class, 'nationalStore'])->name('admins.national.store');
        Route::get('/nationaux/{id}/edit', [AdminController::class, 'nationalEdit'])->name('admins.national.edit');
        Route::put('/nationaux/{id}', [AdminController::class, 'nationalUpdate'])->name('admins.national.update');
        Route::delete('/nationaux/{id}', [AdminController::class, 'nationalDestroy'])->name('admins.national.destroy');

        // Admin National : gestion des admins régionaux
        Route::get('/regionaux', [AdminController::class, 'regionalIndex'])->name('admins.regional.index');
        Route::get('/regionaux/create', [AdminController::class, 'regionalCreate'])->name('admins.regional.create');
        Route::post('/regionaux', [AdminController::class, 'regionalStore'])->name('admins.regional.store');
        Route::get('/regionaux/{id}/edit', [AdminController::class, 'regionalEdit'])->name('admins.regional.edit');
        Route::put('/regionaux/{id}', [AdminController::class, 'regionalUpdate'])->name('admins.regional.update');
        Route::delete('/regionaux/{id}', [AdminController::class, 'regionalDestroy'])->name('admins.regional.destroy');
    });

     // Gestion des membres (modification)
    Route::get('/membres/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/membres/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/membres/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

    // Transfert de membre vers une autre région (admin national)
    Route::get('/membres/{id}/transfert', [MemberController::class, 'transferForm'])->name('members.transfer.form');
    Route::put('/membres/{id}/transfert', [MemberController::class, 'transfer'])->name('members.transfer');

});


