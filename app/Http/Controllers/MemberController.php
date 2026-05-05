<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Member;
use App\Models\Country;
use App\Models\Region;
use App\Models\Grade;
use App\Mail\MemberRegistrationConfirmation;
use App\Mail\NewMemberNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
//use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function create()
    {
        // Récupérer la liste des pays pour le select
        $countries = Country::orderBy('name')->get();

        // Récupérer les grades
        $grades = Grade::orderBy('level')->get();

        return view('members.register', compact('countries', 'grades'));
    }

    /**
     * Enregistrer un nouveau membre
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            // Informations personnelles
            'last_name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'blood_group' => 'nullable|string|max:10',
            'nationality' => 'nullable|string|max:255',

            // Contact
            'email' => 'nullable|email|max:255|unique:members,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'nearest_police_station' => 'nullable|string|max:255',

            // Identité
            'passport_number' => 'nullable|string|max:50',
            'cni_number' => 'nullable|string|max:50',
            'citizenship_id' => 'nullable|string|max:50',

            // Professionnel
            'occupation' => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',

            // USCIA
            'grade_name' => 'required|string|max:255',
            'membership_date' => 'nullable|date',

            // Localisation (sélectionnée par le membre)
            'country_id' => 'required|exists:countries,id',
            'region_id' => 'required|exists:regions,id',

            // Juridique
            'has_been_convicted' => 'nullable|boolean',
            'conviction_details' => 'nullable|string|required_if:has_been_convicted,true',

            // Religieux
            'is_pastor' => 'nullable|boolean',
            'religious_denomination' => 'nullable|string|max:255',

            // Fichiers
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'letter_of_recommendation' => 'nullable|file|mimes:pdf|max:5120',
            'criminal_record' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Générer un numéro USCIA unique
        $validated['uscia_number'] = $this->generateUsciaNumber();

        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('members/photos', 'public');
            $validated['photo_path'] = $path;
        }

        // Gérer l'upload du CV
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('members/cv', 'public');
            $validated['cv_path'] = $path;
        }

        // Gérer l'upload de la lettre de recommandation
        if ($request->hasFile('letter_of_recommendation')) {
            $path = $request->file('letter_of_recommendation')->store('members/letters', 'public');
            $validated['letter_of_recommendation_path'] = $path;
        }

        // Gérer l'upload du casier judiciaire
        if ($request->hasFile('criminal_record')) {
            $path = $request->file('criminal_record')->store('members/criminal', 'public');
            $validated['criminal_record_path'] = $path;
        }

        // Ajouter les champs de traçabilité
        $validated['created_by'] = null; // Inscription publique
        $validated['updated_by'] = null; // Inscription publique

        // Créer le membre
        $member = Member::create($validated);

        return redirect()->route('member.create')
            ->with('success', 'Votre inscription a été enregistrée avec succès !');

 // ========== ENVOI DES EMAILS ==========

        // 1. Envoyer un email de confirmation au membre (si email fourni)
        if ($member->email) {
            try {
                Mail::to($member->email)->send(new MemberRegistrationConfirmation($member));
            } catch (\Exception $e) {
                // Log l'erreur mais continue
                \Log::error('Erreur envoi email confirmation: ' . $e->getMessage());
            }
        }

        // 2. Notifier l'admin régional de la région du membre
        $regionalAdmin = User::where('role', 'regional_admin')
                             ->where('region_id', $member->region_id)
                             ->where('is_active', true)
                             ->first();
                              if ($regionalAdmin && $regionalAdmin->email) {
            try {
                Mail::to($regionalAdmin->email)->send(new NewMemberNotification($member, $regionalAdmin));
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email admin régional: ' . $e->getMessage());
            }
        }

        // 3. Optionnel : Notifier l'admin national du pays
        $nationalAdmin = User::where('role', 'national_admin')
                             ->where('country_id', $member->country_id)
                             ->where('is_active', true)
                             ->first();

        if ($nationalAdmin && $nationalAdmin->email) {
            try {
                Mail::to($nationalAdmin->email)->send(new NewMemberNotification($member, $nationalAdmin));
                 } catch (\Exception $e) {
                \Log::error('Erreur envoi email admin national: ' . $e->getMessage());
            }
        }

        // ========== FIN ENVOI EMAILS ==========

        return redirect()->route('member.create')
                         ->with('success', 'Votre inscription a été enregistrée avec succès ! Un email de confirmation vous a été envoyé.');

    }

    /**
     * Générer un numéro USCIA unique
     */
    private function generateUsciaNumber()
    {
        do {
            // Format: USCIA + Année + 6 chiffres aléatoires
            $number = 'USCIA-' . date('Y') . '-' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Member::where('uscia_number', $number)->exists());

        return $number;
    }
    public function edit($id)
    {
        $user = Auth::user();
        $member = Member::with(['country', 'region', 'grade'])->findOrFail($id);

        // Vérifier les permissions
        if ($user->isRegionalAdmin() && $member->region_id != $user->region_id) {
            abort(403, 'Vous ne pouvez modifier que les membres de votre région.');
        }

        if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
            abort(403, 'Vous ne pouvez modifier que les membres de votre pays.');
        }

        if (!$user->isSuperAdmin() && !$user->isNationalAdmin() && !$user->isRegionalAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        // Données pour les formulaires
        $countries = Country::orderBy('name')->get();
        $grades = Grade::orderBy('level')->get();

        // Pour l'admin régional : seulement sa région
        if ($user->isRegionalAdmin()) {
            $regions = Region::where('id', $user->region_id)->get();
        }
        // Pour l'admin national : toutes les régions de son pays
        elseif ($user->isNationalAdmin()) {
            $regions = Region::where('country_id', $user->country_id)->orderBy('name')->get();
        }
        // Pour le super admin : toutes les régions du pays du membre
        else {
            $regions = Region::where('country_id', $member->country_id)->orderBy('name')->get();
        }

        return view('members.edit', compact('member', 'countries', 'regions', 'grades'));
    }

    /**
     * Mettre à jour un membre
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $member = Member::findOrFail($id);

        // Vérifier les permissions
        if ($user->isRegionalAdmin() && $member->region_id != $user->region_id) {
            abort(403, 'Vous ne pouvez modifier que les membres de votre région.');
        }

        if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
            abort(403, 'Vous ne pouvez modifier que les membres de votre pays.');
        }

        // Validation des données
        $validated = $request->validate([
            // Informations personnelles
            'last_name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'blood_group' => 'nullable|string|max:10',
            'nationality' => 'nullable|string|max:255',

            // Contact
            'email' => 'nullable|email|max:255|unique:members,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'nearest_police_station' => 'nullable|string|max:255',

            // Identité
            'passport_number' => 'nullable|string|max:50',
            'cni_number' => 'nullable|string|max:50',
            'citizenship_id' => 'nullable|string|max:50',

            // Professionnel
            'occupation' => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',

            // USCIA
            'grade_name' => 'required|string|max:255',
            'membership_date' => 'nullable|date',

            // Localisation
            'country_id' => 'required|exists:countries,id',
            'region_id' => 'required|exists:regions,id',

            // Juridique
            'has_been_convicted' => 'nullable|boolean',
            'conviction_details' => 'nullable|string|required_if:has_been_convicted,true',

            // Religieux
            'is_pastor' => 'nullable|boolean',
            'religious_denomination' => 'nullable|string|max:255',
        ]);

        // Vérifier que la région appartient bien au pays
        $region = Region::find($validated['region_id']);
        if ($region->country_id != $validated['country_id']) {
            return back()->with('error', 'La région ne correspond pas au pays sélectionné.');
        }

        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $path = $request->file('photo')->store('members/photos', 'public');
            $validated['photo_path'] = $path;
        }

        // Gérer l'upload du CV
        if ($request->hasFile('cv')) {
            if ($member->cv_path) {
                Storage::disk('public')->delete($member->cv_path);
            }
            $path = $request->file('cv')->store('members/cv', 'public');
            $validated['cv_path'] = $path;
        }

        // Gérer l'upload de la lettre de recommandation
        if ($request->hasFile('letter_of_recommendation')) {
            if ($member->letter_of_recommendation_path) {
                Storage::disk('public')->delete($member->letter_of_recommendation_path);
            }
            $path = $request->file('letter_of_recommendation')->store('members/letters', 'public');
            $validated['letter_of_recommendation_path'] = $path;
        }

        // Gérer l'upload du casier judiciaire
        if ($request->hasFile('criminal_record')) {
            if ($member->criminal_record_path) {
                Storage::disk('public')->delete($member->criminal_record_path);
            }
            $path = $request->file('criminal_record')->store('members/criminal', 'public');
            $validated['criminal_record_path'] = $path;
        }

        // Mettre à jour le membre
        $validated['updated_by'] = $user->id;
        $member->update($validated);

        return redirect()->route('members.show', $member->id)
            ->with('success', 'Les informations du membre ont été mises à jour avec succès !');
    }

    /**
     * Supprimer un membre
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $member = Member::findOrFail($id);

        // Vérifier les permissions
        if ($user->isRegionalAdmin() && $member->region_id != $user->region_id) {
            abort(403, 'Vous ne pouvez supprimer que les membres de votre région.');
        }

        if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
            abort(403, 'Vous ne pouvez supprimer que les membres de votre pays.');
        }

        // Supprimer les fichiers associés
        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }
        if ($member->cv_path) {
            Storage::disk('public')->delete($member->cv_path);
        }
        if ($member->letter_of_recommendation_path) {
            Storage::disk('public')->delete($member->letter_of_recommendation_path);
        }
        if ($member->criminal_record_path) {
            Storage::disk('public')->delete($member->criminal_record_path);
        }

        $member->delete();

        // Redirection selon le rôle
        if ($user->isSuperAdmin()) {
            return redirect()->route('dashboard.super-admin')->with('success', 'Membre supprimé avec succès !');
        } elseif ($user->isNationalAdmin()) {
            return redirect()->route('dashboard.national')->with('success', 'Membre supprimé avec succès !');
        } else {
            return redirect()->route('dashboard.regional')->with('success', 'Membre supprimé avec succès !');
        }
    }

    /**
     * Afficher le formulaire de transfert d'un membre
     */
    public function transferForm($id)
    {
        $user = Auth::user();

        // Seul l'admin national ou super admin peut transférer
        if (!$user->isNationalAdmin() && !$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $member = Member::with(['country', 'region'])->findOrFail($id);

        // Vérifier que le membre est dans le pays de l'admin national
        if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
            abort(403, 'Vous ne pouvez transférer que les membres de votre pays.');
        }

        // Récupérer les régions du pays
        $regions = Region::where('country_id', $member->country_id)
            ->orderBy('name')
            ->get();

        return view('members.transfer', compact('member', 'regions'));
    }

    /**
     * Transférer un membre vers une autre région
     */
    public function transfer(Request $request, $id)
    {
        $user = Auth::user();

        // Seul l'admin national ou super admin peut transférer
        if (!$user->isNationalAdmin() && !$user->isSuperAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $member = Member::findOrFail($id);

        // Vérifier que le membre est dans le pays de l'admin national
        if ($user->isNationalAdmin() && $member->country_id != $user->country_id) {
            abort(403, 'Vous ne pouvez transférer que les membres de votre pays.');
        }

        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
        ]);

        // Vérifier que la région appartient bien au même pays
        $region = Region::find($validated['region_id']);
        if ($region->country_id != $member->country_id) {
            return back()->with('error', 'La région de destination doit être dans le même pays.');
        }

        $oldRegion = $member->region->name;
        $newRegion = $region->name;

        $member->update([
            'region_id' => $validated['region_id'],
            'updated_by' => $user->id,
        ]);

        return redirect()->route('members.show', $member->id)
            ->with('success', "Le membre a été transféré de {$oldRegion} vers {$newRegion}.");
    }
}
