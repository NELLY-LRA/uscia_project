<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Models\User;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traiter la tentative de connexion
     */
    public function login(Request $request)
    {
        // Validation simple
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Vérifier si le compte est actif
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Votre compte est désactivé. Contactez votre supérieur.',
                ]);
            }

            // Mettre à jour la dernière connexion
            $user->update(['last_login_at' => now()]);

            // Rediriger selon le rôle
            return $this->redirectBasedOnRole($user);
        }

        // Échec de connexion
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Rediriger l'utilisateur selon son rôle
     */
    private function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('dashboard.super-admin');
            case 'national_admin':
                return redirect()->route('dashboard.national');
            case 'regional_admin':
                return redirect()->route('dashboard.regional');
            default:
                return redirect()->route('dashboard');
        }
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
