<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Membre - USCIA Afrique</title>
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
        }

        .header h1 {
            color: #0B2A4A;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #D4AF37;
            font-weight: bold;
        }

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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        label .required {
            color: #e74c3c;
        }

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

        input[type="file"] {
            padding: 8px;
            background: white;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .help-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .btn-submit {
            background: #0B2A4A;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #1a3a5a;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }

        .footer a {
            color: #0B2A4A;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>USCIA AFRIQUE</h1>
            <p>Formulaire d'inscription des aumôniers</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
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

        <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1: INFORMATIONS PERSONNELLES -->
            <div class="section">
                <h2><span>1</span> Informations personnelles</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nom <span class="required">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sexe</label>
                        <select name="gender">
                            <option value="">Sélectionner</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculin</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>

                    <div class="form-group">
                        <label>Groupe sanguin</label>
                        <select name="blood_group">
                            <option value="">Sélectionner</option>
                            <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                            <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nationalité</label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}">
                </div>
            </div>

            <!-- SECTION 2: CONTACT ET ADRESSE -->
            <div class="section">
                <h2><span>2</span> Contact et adresse</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse</label>
                    <textarea name="address" rows="2">{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Commissariat de police le plus proche</label>
                    <input type="text" name="nearest_police_station" value="{{ old('nearest_police_station') }}">
                </div>
            </div>

            <!-- SECTION 3: PIÈCES D'IDENTITÉ -->
            <div class="section">
                <h2><span>3</span> Pièces d'identité</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Numéro de passeport</label>
                        <input type="text" name="passport_number" value="{{ old('passport_number') }}">
                    </div>

                    <div class="form-group">
                        <label>Numéro CNI</label>
                        <input type="text" name="cni_number" value="{{ old('cni_number') }}">
                    </div>

                    <div class="form-group">
                        <label>Numéro carte de séjour</label>
                        <input type="text" name="citizenship_id" value="{{ old('citizenship_id') }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 4: INFORMATIONS PROFESSIONNELLES -->
            <div class="section">
                <h2><span>4</span> Informations professionnelles</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Profession</label>
                        <input type="text" name="occupation" value="{{ old('occupation') }}">
                    </div>

                    <div class="form-group">
                        <label>Niveau d'études</label>
                        <input type="text" name="educational_level" value="{{ old('educational_level') }}">
                    </div>

                    <div class="form-group">
                        <label>Organisation</label>
                        <input type="text" name="organization" value="{{ old('organization') }}">
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
                                <option value="{{ $grade->name }}" {{ old('grade_name') == $grade->name ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date d'engagement</label>
                        <input type="date" name="membership_date" value="{{ old('membership_date') }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 6: LOCALISATION GÉOGRAPHIQUE -->
            <div class="section">
                <h2><span>6</span> Localisation (pays et région d'affectation)</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Pays <span class="required">*</span></label>
                        <select name="country_id" id="country-select" required>
                            <option value="">Sélectionner un pays</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Région <span class="required">*</span></label>
                        <select name="region_id" id="region-select" required>
                            <option value="">Sélectionnez d'abord un pays</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 7: INFORMATIONS JURIDIQUES -->
            <div class="section">
                <h2><span>7</span> Informations juridiques</h2>

                <div class="checkbox-group" style="margin-bottom: 15px;">
                    <input type="checkbox" name="has_been_convicted" id="has_been_convicted" value="1" {{ old('has_been_convicted') ? 'checked' : '' }}>
                    <label for="has_been_convicted">Avez-vous déjà été condamné ?</label>
                </div>

                <div class="form-group" id="conviction_details_group" style="{{ old('has_been_convicted') ? '' : 'display: none;' }}">
                    <label>Détails de la condamnation</label>
                    <textarea name="conviction_details" rows="3">{{ old('conviction_details') }}</textarea>
                </div>
            </div>

            <!-- SECTION 8: INFORMATIONS RELIGIEUSES -->
            <div class="section">
                <h2><span>8</span> Informations religieuses</h2>

                <div class="checkbox-group" style="margin-bottom: 15px;">
                    <input type="checkbox" name="is_pastor" id="is_pastor" value="1" {{ old('is_pastor') ? 'checked' : '' }}>
                    <label for="is_pastor">Êtes-vous pasteur ?</label>
                </div>

                <div class="form-group">
                    <label>Dénomination religieuse</label>
                    <input type="text" name="religious_denomination" value="{{ old('religious_denomination') }}">
                </div>
            </div>

            <!-- SECTION 9: DOCUMENTS -->
            <div class="section">
                <h2><span>9</span> Documents (photos, CV, etc.)</h2>

                <div class="form-group">
                    <label>Photo d'identité</label>
                    <input type="file" name="photo" accept="image/jpeg,image/png">
                    <div class="help-text">Format JPG ou PNG, max 2 Mo</div>
                </div>

                <div class="form-group">
                    <label>Curriculum Vitae (CV)</label>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx">
                    <div class="help-text">Format PDF ou Word, max 5 Mo</div>
                </div>

                <div class="form-group">
                    <label>Lettre de recommandation</label>
                    <input type="file" name="letter_of_recommendation" accept=".pdf">
                    <div class="help-text">Format PDF, max 5 Mo</div>
                </div>

                <div class="form-group">
                    <label>Casier judiciaire</label>
                    <input type="file" name="criminal_record" accept=".pdf">
                    <div class="help-text">Format PDF, max 5 Mo</div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Soumettre mes informations</button>
        </form>

        <div class="footer">
            <p>© 2026 USCIA Afrique - Tous droits réservés</p>
        </div>
    </div>

    <script>
        // Script pour charger dynamiquement les régions en fonction du pays sélectionné
        document.getElementById('country-select').addEventListener('change', function() {
            const countryId = this.value;
            const regionSelect = document.getElementById('region-select');

            if (!countryId) {
                regionSelect.innerHTML = '<option value="">Sélectionnez d\'abord un pays</option>';
                return;
            }

            // Désactiver le select pendant le chargement
            regionSelect.disabled = true;
            regionSelect.innerHTML = '<option value="">Chargement...</option>';

            // Requête AJAX pour récupérer les régions
            fetch(`/api/regions/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    regionSelect.innerHTML = '<option value="">Sélectionner une région</option>';
                    data.forEach(region => {
                        regionSelect.innerHTML += `<option value="${region.id}">${region.name}</option>`;
                    });
                    regionSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    regionSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                    regionSelect.disabled = false;
                });
        });

        // Afficher/masquer le champ des détails de condamnation
        document.getElementById('has_been_convicted').addEventListener('change', function() {
            const detailsGroup = document.getElementById('conviction_details_group');
            detailsGroup.style.display = this.checked ? 'block' : 'none';

            if (this.checked) {
                document.querySelector('[name="conviction_details"]').setAttribute('required', 'required');
            } else {
                document.querySelector('[name="conviction_details"]').removeAttribute('required');
            }
        });
    </script>
</body>
</html>
