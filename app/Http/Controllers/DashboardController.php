<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\User;
use App\Models\Country;
use App\Models\Grade;

class DashboardController extends Controller
{
    /**
     * Dashboard général (redirection selon rôle)
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('dashboard.super-admin');
            case 'national_admin':
                return redirect()->route('dashboard.national');
            case 'regional_admin':
                return redirect()->route('dashboard.regional');
            default:
                return redirect()->route('login');
        }
    }

    /**
     * Dashboard Super Admin (vue sur toute l'Afrique)
     */
    public function superAdmin()
{
    $user = Auth::user();

    if (!$user->isSuperAdmin()) {
        abort(403, 'Accès non autorisé');
    }

    // Statistiques globales
    $stats = [
        'total_members' => Member::count(),
        'total_countries' => Country::count(),
        'total_admins' => User::count(),
        'recent_members' => Member::latest()->take(5)->get(),
    ];

    // Données pour les graphiques
    $membersByCountry = Country::withCount('members')
        ->orderBy('members_count', 'desc')
        ->take(10)
        ->get();

    $membersByGrade = Grade::withCount('members')
        ->orderBy('members_count', 'desc')
        ->get();

    $membersByMonth = Member::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month', 'desc')
        ->take(12)
        ->get();

    return view('dashboards.super-admin', compact('stats', 'membersByCountry', 'membersByGrade', 'membersByMonth'));
}

    /**
     * Dashboard Admin National (vue sur son pays)
     */
    public function national()
    {
        $user = Auth::user();

        // Vérifier que c'est bien un admin national
        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        // Vérifier qu'il a un pays assigné
        if (!$user->country_id) {
            abort(403, 'Aucun pays assigné à votre compte');
        }

        // Statistiques du pays
        $stats = [
            'total_members' => Member::where('country_id', $user->country_id)->count(),
            'total_regions' => \App\Models\Region::where('country_id', $user->country_id)->count(),
            'total_regional_admins' => User::where('role', 'regional_admin')
                                          ->where('country_id', $user->country_id)
                                          ->count(),
            'recent_members' => Member::where('country_id', $user->country_id)
                                      ->latest()
                                      ->take(5)
                                      ->get(),
            'members_by_region' => \App\Models\Region::where('country_id', $user->country_id)
                ->withCount('members')
                ->get(),
        ];

        return view('dashboards.national', compact('stats', 'user'));
    }

    /**
 * Dashboard Admin Régional (vue sur sa région)
 */
public function regional()
{
    $user = Auth::user();

    // Vérifier que c'est bien un admin régional
    if (!$user->isRegionalAdmin()) {
        abort(403, 'Accès non autorisé');
    }

    // Vérifier qu'il a une région assignée
    if (!$user->region_id) {
        abort(403, 'Aucune région assignée à votre compte');
    }

    // Récupérer tous les membres de sa région
    $members = Member::where('region_id', $user->region_id)
                     ->orderBy('created_at', 'desc')
                     ->paginate(20);

    // Statistiques de la région
    $stats = [
        'total_members' => Member::where('region_id', $user->region_id)->count(),
        'members_by_gender' => [
            'male' => Member::where('region_id', $user->region_id)->where('gender', 'male')->count(),
            'female' => Member::where('region_id', $user->region_id)->where('gender', 'female')->count(),
        ],
        'recent_members' => Member::where('region_id', $user->region_id)
                                  ->latest()
                                  ->take(5)
                                  ->get(),
    ];

    return view('dashboards.regional', compact('stats', 'user', 'members'));
}

/**
 * Voir le détail d'un membre ...
 */
public function showMember($id)
{
    $user = Auth::user();

    // Récupérer le membre
    $member = Member::with(['country', 'region', 'grade'])->findOrFail($id);

    // Vérifier que l'admin a le droit de voir ce membre
    if ($user->isRegionalAdmin() && $member->region_id != $user->region_id) {
        abort(403, 'Accès non autorisé');
    }

    if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
        abort(403, 'Accès non autorisé');
    }

    return view('members.show', compact('member'));
}
}
