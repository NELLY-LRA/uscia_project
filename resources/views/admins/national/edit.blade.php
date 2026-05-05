<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Admin National - USCIA</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: #0B2A4A;
            color: white;
            padding: 15px 20px;
            margin: -30px -30px 30px -30px;
            border-radius: 10px 10px 0 0;
        }
        .header h1 { font-size: 20px; color: #D4AF37; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, select:focus { border-color: #D4AF37; outline: none; }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkbox-group input { width: auto; }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-primary { background: #0B2A4A; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .help-text { font-size: 12px; color: #999; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>USCIA AFRIQUE - Modifier un Admin National</h1>
        </div>

        @if($errors->any())
            <div class="alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admins.national.update', $admin->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom complet <span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email <span style="color: red;">*</span></label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>
            </div>

            <div class="form-group">
                <label>Pays <span style="color: red;">*</span></label>
                <select name="country_id" required>
                    <option value="">Sélectionner un pays</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $admin->country_id) == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="password">
                <div class="help-text">Laisser vide pour conserver l'ancien mot de passe</div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $admin->is_active) ? 'checked' : '' }}>
                    <label for="is_active">Compte actif</label>
                </div>
            </div>

            <div style="display: flex; gap: 10px; justify-content: space-between;">
                <a href="{{ route('admins.national.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</body>
</html>
