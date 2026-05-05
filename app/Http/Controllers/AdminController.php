<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\Region;

class AdminController extends Controller
{
   
    // ==================== GESTION DES ADMINS NATIONAUX (Super Admin seulement) ====================

    /**
     * Liste des admins nationaux
     */
    public function nationalIndex()
    {
        $user = Auth::user();

        // Vérifier que c'est un Super Admin
        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admins = User::where('role', 'national_admin')
                      ->with('country')
                      ->orderBy('created_at', 'desc')
                      ->paginate(20);

        return view('admins.national.index', compact('admins'));
    }

    /**
     * Formulaire de création d'un admin national
     */
    public function nationalCreate()
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $countries = Country::orderBy('name')->get();

        return view('admins.national.create', compact('countries'));
    }

    /**
     * Enregistrer un nouvel admin national
     */
    public function nationalStore(Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'country_id' => 'required|exists:countries,id',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'national_admin',
            'country_id' => $validated['country_id'],
            'is_active' => true,
            'created_by' => $user->id,
        ]);

        return redirect()->route('admins.national.index')
                         ->with('success', 'Admin national créé avec succès !');
    }

    /**
     * Formulaire d'édition d'un admin national
     */
    public function nationalEdit($id)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'national_admin')->findOrFail($id);
        $countries = Country::orderBy('name')->get();

        return view('admins.national.edit', compact('admin', 'countries'));
    }

    /**
     * Mettre à jour un admin national
     */
    public function nationalUpdate(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'national_admin')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country_id' => 'required|exists:countries,id',
            'is_active' => 'boolean',
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'country_id' => $validated['country_id'],
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->filled('password')) {
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admins.national.index')
                         ->with('success', 'Admin national modifié avec succès !');
    }

    /**
     * Supprimer un admin national
     */
    public function nationalDestroy($id)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'national_admin')->findOrFail($id);

        // Vérifier qu'on ne se supprime pas soi-même
        if ($admin->id == $user->id) {
            return back()->with('error', 'Vous ne pouvez pas vous supprimer vous-même.');
        }

        $admin->delete();

        return redirect()->route('admins.national.index')
                         ->with('success', 'Admin national supprimé avec succès !');
    }

    // ==================== GESTION DES ADMINS RÉGIONAUX (Admin National seulement) ====================

    /**
     * Liste des admins régionaux
     */
    public function regionalIndex()
    {
        $user = Auth::user();

        // Vérifier que c'est un Admin National
        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admins = User::where('role', 'regional_admin')
                      ->where('country_id', $user->country_id)
                      ->with('region')
                      ->orderBy('created_at', 'desc')
                      ->paginate(20);

        return view('admins.regional.index', compact('admins'));
    }

    /**
     * Formulaire de création d'un admin régional
     */
    public function regionalCreate()
    {
        $user = Auth::user();

        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $regions = Region::where('country_id', $user->country_id)
                         ->orderBy('name')
                         ->get();

        return view('admins.regional.create', compact('regions'));
    }

    /**
     * Enregistrer un nouvel admin régional
     */
    public function regionalStore(Request $request)
    {
        $user = Auth::user();

        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'region_id' => 'required|exists:regions,id',
            'password' => 'required|string|min:6',
        ]);

        // Vérifier que la région appartient bien au pays de l'admin national
        $region = Region::find($validated['region_id']);
        if ($region->country_id != $user->country_id) {
            return back()->with('error', 'Région invalide pour votre pays.');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'regional_admin',
            'country_id' => $user->country_id,
            'region_id' => $validated['region_id'],
            'is_active' => true,
            'created_by' => $user->id,
        ]);

        return redirect()->route('admins.regional.index')
                         ->with('success', 'Admin régional créé avec succès !');
    }

    /**
     * Formulaire d'édition d'un admin régional
     */
    public function regionalEdit($id)
    {
        $user = Auth::user();

        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'regional_admin')
                     ->where('country_id', $user->country_id)
                     ->findOrFail($id);

        $regions = Region::where('country_id', $user->country_id)
                         ->orderBy('name')
                         ->get();

        return view('admins.regional.edit', compact('admin', 'regions'));
    }

    /**
     * Mettre à jour un admin régional
     */
    public function regionalUpdate(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'regional_admin')
                     ->where('country_id', $user->country_id)
                     ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'region_id' => 'required|exists:regions,id',
            'is_active' => 'boolean',
        ]);

        // Vérifier que la région appartient bien au pays
        $region = Region::find($validated['region_id']);
        if ($region->country_id != $user->country_id) {
            return back()->with('error', 'Région invalide pour votre pays.');
        }

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'region_id' => $validated['region_id'],
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->filled('password')) {
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admins.regional.index')
                         ->with('success', 'Admin régional modifié avec succès !');
    }

    /**
     * Supprimer un admin régional
     */
    public function regionalDestroy($id)
    {
        $user = Auth::user();

        if (!$user->isNationalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $admin = User::where('role', 'regional_admin')
                     ->where('country_id', $user->country_id)
                     ->findOrFail($id);

        $admin->delete();

        return redirect()->route('admins.regional.index')
                         ->with('success', 'Admin régional supprimé avec succès !');
    }
}
