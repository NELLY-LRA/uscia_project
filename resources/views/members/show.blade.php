<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche membre - USCIA Afrique</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #0B2A4A;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .header h1 {
            font-size: 20px;
            color: #D4AF37;
        }

        .back-btn {
            background: #D4AF37;
            color: #0B2A4A;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .profile-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .photo {
            width: 150px;
            height: 150px;
            background: #f0f0f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-placeholder {
            text-align: center;
            color: #999;
        }

        .info {
            flex: 1;
        }

        .info h2 {
            color: #0B2A4A;
            margin-bottom: 10px;
        }

        .uscia-badge {
            background: #D4AF37;
            color: #0B2A4A;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .section {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #0B2A4A;
        }

        .section h3 {
            color: #0B2A4A;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: bold;
        }

        .info-value {
            font-size: 14px;
            color: #333;
            margin-top: 5px;
        }

        .documents {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .doc-link {
            background: #e8f4fd;
            color: #0B2A4A;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .doc-link:hover {
            background: #d0e4f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>USCIA AFRIQUE - Fiche du membre</h1>
 <!-- BOUTON RETOUR - Redirige vers le dashboard selon le rôle -->
    <a href="{{
        Auth::user()->isSuperAdmin() ? route('dashboard.super-admin') :
        (Auth::user()->isNationalAdmin() ? route('dashboard.national') :
        route('dashboard.regional'))
    }}"
       style="background: #6c757d; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
        ← Retour
    </a>        </div>

<!-- Boutons d'action -->
<div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
    <!-- Bouton Modifier - visible pour tous les admins qui ont le droit -->
    @if(Auth::user()->isRegionalAdmin() && $member->region_id == Auth::user()->region_id)
        <a href="{{ route('members.edit', $member->id) }}"
           style="background: #D4AF37; color: #0B2A4A; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
            ✏️ Modifier le membre
        </a>
    @endif

    @if(Auth::user()->isNationalAdmin() && $member->country_id == Auth::user()->country_id)
        <a href="{{ route('members.edit', $member->id) }}"
           style="background: #D4AF37; color: #0B2A4A; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
            ✏️ Modifier le membre
        </a>
        <!-- BOUTON TRANSFÉRER POUR ADMIN NATIONAL -->
        <a href="{{ route('members.transfer.form', $member->id) }}"
           style="background: #28a745; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
            🔄 Transférer vers une autre région
        </a>
    @endif

    @if(Auth::user()->isSuperAdmin())
        <a href="{{ route('members.edit', $member->id) }}"
           style="background: #D4AF37; color: #0B2A4A; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
            ✏️ Modifier le membre
        </a>
        <a href="{{ route('members.transfer.form', $member->id) }}"
           style="background: #28a745; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
            🔄 Transférer vers une autre région
        </a>
    @endif
</div>
        <div class="content">
            <div class="profile-header">
                <div class="photo">
                    @if ($member->photo_path)
                        @php
                            $fullPath = storage_path('app/public/' . $member->photo_path);
                            $exists = file_exists($fullPath);
                        @endphp

                        @if ($exists)
                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="Photo"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div class="photo-placeholder"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                                📷<br>
                                Fichier manquant<br>
                                <small style="font-size: 10px;">{{ basename($member->photo_path) }}</small>
                            </div>
                        @endif
                    @else
                        <div class="photo-placeholder"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                            📷<br>
                            Pas de photo
                        </div>
                    @endif
                </div>

                <div class="info">
                    <div class="uscia-badge">{{ $member->uscia_number }}</div>
                    <h2>{{ $member->last_name }} {{ $member->first_name }}</h2>
                    <p><strong>Grade :</strong> {{ $member->grade_name }}</p>
                    <p><strong>Localisation :</strong> {{ $member->region->name ?? 'N/A' }},
                        {{ $member->country->name ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Informations personnelles -->
            <div class="section">
                <h3>👤 Informations personnelles</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Sexe</span>
                        <span
                            class="info-value">{{ $member->gender == 'male' ? 'Masculin' : ($member->gender == 'female' ? 'Féminin' : '-') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date de naissance</span>
                        <span
                            class="info-value">{{ $member->date_of_birth ? date('d/m/Y', strtotime($member->date_of_birth)) : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Groupe sanguin</span>
                        <span class="info-value">{{ $member->blood_group ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nationalité</span>
                        <span class="info-value">{{ $member->nationality ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="section">
                <h3>📞 Contact</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $member->email ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value">{{ $member->phone ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Adresse</span>
                        <span class="info-value">{{ $member->address ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Commissariat proche</span>
                        <span class="info-value">{{ $member->nearest_police_station ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Pièces d'identité -->
            <div class="section">
                <h3>🆔 Pièces d'identité</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Passeport</span>
                        <span class="info-value">{{ $member->passport_number ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">CNI</span>
                        <span class="info-value">{{ $member->cni_number ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Carte de séjour</span>
                        <span class="info-value">{{ $member->citizenship_id ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informations professionnelles -->
            <div class="section">
                <h3>💼 Informations professionnelles</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Profession</span>
                        <span class="info-value">{{ $member->occupation ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Niveau d'études</span>
                        <span class="info-value">{{ $member->educational_level ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Organisation</span>
                        <span class="info-value">{{ $member->organization ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informations USCIA -->
            <div class="section">
                <h3>⚜️ Informations USCIA</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Date d'engagement</span>
                        <span
                            class="info-value">{{ $member->membership_date ? date('d/m/Y', strtotime($member->membership_date)) : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pasteur</span>
                        <span class="info-value">{{ $member->is_pastor ? 'Oui' : 'Non' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Dénomination</span>
                        <span class="info-value">{{ $member->religious_denomination ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Condamnation</span>
                        <span class="info-value">{{ $member->has_been_convicted ? 'Oui' : 'Non' }}</span>
                    </div>
                    @if ($member->has_been_convicted && $member->conviction_details)
                        <div class="info-item">
                            <span class="info-label">Détails condamnation</span>
                            <span class="info-value">{{ $member->conviction_details }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Documents -->
            @if ($member->cv_path || $member->letter_of_recommendation_path || $member->criminal_record_path)
                <div class="section">
                    <h3>📄 Documents</h3>
                    <div class="documents">
                        @if ($member->cv_path)
                            <a href="{{ asset('storage/' . $member->cv_path) }}" target="_blank" class="doc-link">📄
                                CV</a>
                        @endif
                        @if ($member->letter_of_recommendation_path)
                            <a href="{{ asset('storage/' . $member->letter_of_recommendation_path) }}" target="_blank"
                                class="doc-link">📝 Lettre de recommandation</a>
                        @endif
                        @if ($member->criminal_record_path)
                            <a href="{{ asset('storage/' . $member->criminal_record_path) }}" target="_blank"
                                class="doc-link">⚖️ Casier judiciaire</a>
                        @endif
                    </div>
                </div>
            @endif

            <div class="section" style="background: #f0f8ff;">
                <h3>📅 Informations d'enregistrement</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Date d'inscription</span>
                        <span class="info-value">{{ $member->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Dernière modification</span>
                        <span class="info-value">{{ $member->updated_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
