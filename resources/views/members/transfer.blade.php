<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transférer Membre - USCIA Afrique</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container {
            max-width: 600px;
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
        .member-info {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .member-info p { margin: 8px 0; }
        .member-info strong { color: #0B2A4A; }
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }
        select:focus {
            border-color: #D4AF37;
            outline: none;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            margin-top: 20px;
        }
        .info-box {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #856404;
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
            <p>Transférer un membre vers une autre région</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
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

        <div class="member-info">
            <p><strong>📋 Numéro USCIA :</strong> <span class="uscia-badge">{{ $member->uscia_number }}</span></p>
            <p><strong>👤 Nom :</strong> {{ $member->last_name }} {{ $member->first_name }}</p>
            <p><strong>📍 Région actuelle :</strong> {{ $member->region->name ?? 'N/A' }}</p>
            <p><strong>🌍 Pays :</strong> {{ $member->country->name ?? 'N/A' }}</p>
        </div>

        <div class="info-box">
            ℹ️ Le transfert d'un membre vers une autre région conserve toutes ses informations (documents, grade, etc.).
            Seule sa région d'affectation sera modifiée.
        </div>

        <form method="POST" action="{{ route('members.transfer', $member->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="region_id">Nouvelle région <span style="color: red;">*</span></label>
                <select name="region_id" id="region_id" required>
                    <option value="">Sélectionner une région</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('members.show', $member->id) }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Confirmer le transfert</button>
            </div>
        </form>
    </div>
</body>
</html>
