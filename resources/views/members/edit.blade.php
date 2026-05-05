<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Membre - USCIA Afrique</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #D4AF37;
        }
        .header h1 { color: #0B2A4A; font-size: 24px; }
        .header p { color: #D4AF37; font-weight: bold; }
        .section {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #0B2A4A;
        }
        .section h2 {
            color: #0B2A4A;
            font-size: 18px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .section h2 span {
            background: #0B2A4A;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 10px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-group { margin-bottom: 15px; }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }
        label .required { color: #e74c3c; }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #D4AF37;
            outline: none;
        }
        input[type="file"] { padding: 8px; background: white; }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkbox-group input[type="checkbox"] { width: auto; }
        .help-text { font-size: 12px; color: #999; margin-top: 5px; }
        .current-photo {
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .current-photo img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: #0B2A4A; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>USCIA AFRIQUE</h1>
            <p>Modifier les informations du membre</p>
            <div class="uscia-badge">{{ $member->uscia_number }}</div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('members.update', $member->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- SECTION 1: INFORMATIONS PERSONNELLES -->
            <div class="section">
                <h2><span>1</span> Informations personnelles</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nom <span class="required">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name', $member->last_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $member->first_name) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sexe</label>
                        <select name="gender">
                            <option value="">Sélectionner</option>
                            <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Masculin</option>
                            <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth ? date('Y-m-d', strtotime($member->date_of_birth)) : '') }}">
                    </div>

                    <div class="form-group">
                        <label>Groupe sanguin</label>
                        <select name="blood_group">
                            <option value="">Sélectionner</option>
                            <option value="A+" {{ old('blood_group', $member->blood_group) == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('blood_group', $member->blood_group) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('blood_group', $member->blood_group) == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('blood_group', $member->blood_group) == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="O+" {{ old('blood_group', $member->blood_group) == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('blood_group', $member->blood_group) == 'O-' ? 'selected' : '' }}>O-</option>
                            <option value="AB+" {{ old('blood_group', $member->blood_group) == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('blood_group', $member->blood_group) == 'AB-' ? 'selected' : '' }}>AB-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nationalité</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $member->nationality) }}">
                </div>
            </div>

            <!-- SECTION 2: CONTACT ET ADRESSE -->
            <div class="section">
                <h2><span>2</span> Contact et adresse</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $member->email) }}">
                    </div>

                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" value="{{ old('phone', $member->phone) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse</label>
                    <textarea name="address" rows="2">{{ old('address', $member->address) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Commissariat de police le plus proche</label>
                    <input type="text" name="nearest_police_station" value="{{ old('nearest_police_station', $member->nearest_police_station) }}">
                </div>
            </div>

            <!-- SECTION 3: PIÈCES D'IDENTITÉ -->
            <div class="section">
                <h2><span>3</span> Pièces d'identité</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Numéro de passeport</label>
                        <input type="text" name="passport_number" value="{{ old('passport_number', $member->passport_number) }}">
                    </div>

                    <div class="form-group">
                        <label>Numéro CNI</label>
                        <input type="text" name="cni_number" value="{{ old('cni_number', $member->cni_number) }}">
                    </div>

                    <div class="form-group">
                        <label>Numéro carte de séjour</label>
                        <input type="text" name="citizenship_id" value="{{ old('citizenship_id', $member->citizenship_id) }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 4: INFORMATIONS PROFESSIONNELLES -->
            <div class="section">
                <h2><span>4</span> Informations professionnelles</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Profession</label>
                        <input type="text" name="occupation" value="{{ old('occupation', $member->occupation) }}">
                    </div>

                    <div class="form-group">
                        <label>Niveau d'études</label>
                        <input type="text" name="educational_level" value="{{ old('educational_level', $member->educational_level) }}">
                    </div>

                    <div class="form-group">
                        <label>Organisation</label>
                        <input type="text" name="organization" value="{{ old('organization', $member->organization) }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 5: INFORMATIONS USCIA -->
            <div class="section">
                <h2><span>5</span> Informations USCIA</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Grade <span class="required">*</span></label>
                        <select name="grade_name" required>
                            <option value="">Sélectionner un grade</option>
                            @foreach($grades as $grade)
                                @if($grade->name !== 'Aumônier Général' && $grade->name !== 'Général')
                                    <option value="{{ $grade->name }}" {{ old('grade_name', $member->grade_name) == $grade->name ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date d'engagement</label>
                        <input type="date" name="membership_date" value="{{ old('membership_date', $member->membership_date ? date('Y-m-d', strtotime($member->membership_date)) : '') }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 6: LOCALISATION GÉOGRAPHIQUE -->
            <div class="section">
                <h2><span>6</span> Localisation</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Pays <span class="required">*</span></label>
                        <select name="country_id" id="country-select" required>
                            <option value="">Sélectionner un pays</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $member->country_id) == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Région <span class="required">*</span></label>
                        <select name="region_id" id="region-select" required>
                            <option value="">Sélectionner une région</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region_id', $member->region_id) == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 7: INFORMATIONS JURIDIQUES -->
            <div class="section">
                <h2><span>7</span> Informations juridiques</h2>

                <div class="checkbox-group" style="margin-bottom: 15px;">
                    <input type="checkbox" name="has_been_convicted" id="has_been_convicted" value="1" {{ old('has_been_convicted', $member->has_been_convicted) ? 'checked' : '' }}>
                    <label for="has_been_convicted">Avez-vous déjà été condamné ?</label>
                </div>

                <div class="form-group" id="conviction_details_group" style="{{ old('has_been_convicted', $member->has_been_convicted) ? '' : 'display: none;' }}">
                    <label>Détails de la condamnation</label>
                    <textarea name="conviction_details" rows="3">{{ old('conviction_details', $member->conviction_details) }}</textarea>
                </div>
            </div>

            <!-- SECTION 8: INFORMATIONS RELIGIEUSES -->
            <div class="section">
                <h2><span>8</span> Informations religieuses</h2>

                <div class="checkbox-group" style="margin-bottom: 15px;">
                    <input type="checkbox" name="is_pastor" id="is_pastor" value="1" {{ old('is_pastor', $member->is_pastor) ? 'checked' : '' }}>
                    <label for="is_pastor">Êtes-vous pasteur ?</label>
                </div>

                <div class="form-group">
                    <label>Dénomination religieuse</label>
                    <input type="text" name="religious_denomination" value="{{ old('religious_denomination', $member->religious_denomination) }}">
                </div>
            </div>

            <!-- SECTION 9: DOCUMENTS -->
            <div class="section">
                <h2><span>9</span> Documents</h2>

                @if($member->photo_path)
                    <div class="current-photo">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="Photo actuelle">
                        <span>Photo actuelle</span>
                    </div>
                @endif

                <div class="form-group">
                    <label>Nouvelle photo d'identité</label>
                    <input type="file" name="photo" accept="image/jpeg,image/png">
                    <div class="help-text">Format JPG ou PNG, max 2 Mo. Laissez vide pour conserver l'actuelle.</div>
                </div>

                @if($member->cv_path)
                    <div class="help-text">📄 CV actuel : <a href="{{ asset('storage/' . $member->cv_path) }}" target="_blank">Voir</a></div>
                @endif
                <div class="form-group">
                    <label>Nouveau Curriculum Vitae (CV)</label>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx">
                    <div class="help-text">Format PDF ou Word, max 5 Mo</div>
                </div>

                @if($member->letter_of_recommendation_path)
                    <div class="help-text">📝 Lettre actuelle : <a href="{{ asset('storage/' . $member->letter_of_recommendation_path) }}" target="_blank">Voir</a></div>
                @endif
                <div class="form-group">
                    <label>Nouvelle lettre de recommandation</label>
                    <input type="file" name="letter_of_recommendation" accept=".pdf">
                    <div class="help-text">Format PDF, max 5 Mo</div>
                </div>

                @if($member->criminal_record_path)
                    <div class="help-text">⚖️ Casier actuel : <a href="{{ asset('storage/' . $member->criminal_record_path) }}" target="_blank">Voir</a></div>
                @endif
                <div class="form-group">
                    <label>Nouveau casier judiciaire</label>
                    <input type="file" name="criminal_record" accept=".pdf">
                    <div class="help-text">Format PDF, max 5 Mo</div>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>

        <!-- Formulaire de suppression -->
        <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ? Cette action est irréversible.')" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width: 100%;">🗑️ Supprimer ce membre</button>
        </form>
    </div>

    <script>
        // Chargement dynamique des régions
        document.getElementById('country-select').addEventListener('change', function() {
            const countryId = this.value;
            const regionSelect = document.getElementById('region-select');

            if (!countryId) {
                regionSelect.innerHTML = '<option value="">Sélectionnez d\'abord un pays</option>';
                return;
            }

            regionSelect.disabled = true;
            regionSelect.innerHTML = '<option value="">Chargement...</option>';

            fetch(`/api/regions/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    regionSelect.innerHTML = '<option value="">Sélectionner une région</option>';
                    data.forEach(region => {
                        const selected = {{ $member->region_id }} == region.id ? 'selected' : '';
                        regionSelect.innerHTML += `<option value="${region.id}" ${selected}>${region.name}</option>`;
                    });
                    regionSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    regionSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                    regionSelect.disabled = false;
                });
        });

        // Afficher/masquer les détails de condamnation
        document.getElementById('has_been_convicted').addEventListener('change', function() {
            const detailsGroup = document.getElementById('conviction_details_group');
            detailsGroup.style.display = this.checked ? 'block' : 'none';
        });
    </script>
</body>
</html>
