<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Admin National - USCIA</title>
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
            <h1>USCIA AFRIQUE - Créer un Admin National</h1>
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

        <form method="POST" action="{{ route('admins.national.store') }}">
            @csrf

            <div class="form-group">
                <label>Nom complet <span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Email <span style="color: red;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                <div class="help-text">Utilisé pour la connexion</div>
            </div>

            <div class="form-group">
                <label>Pays <span style="color: red;">*</span></label>
                <select name="country_id" required>
                    <option value="">Sélectionner un pays</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mot de passe <span style="color: red;">*</span></label>
                <input type="password" name="password" required>
                <div class="help-text">Minimum 6 caractères</div>
            </div>

            <div style="display: flex; gap: 10px; justify-content: space-between;">
                <a href="{{ route('admins.national.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Créer l'admin national</button>
            </div>
        </form>
    </div>
</body>
</html>
