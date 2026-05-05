<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCIA Afrique - Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0B2A4A; /* Bleu marine */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-box {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #0B2A4A;
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }

        .logo p {
            color: #D4AF37; /* Or */
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #E0E0E0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #D4AF37;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #D4AF37;
            color: #0B2A4A;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #c49b2c;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }

        .footer p {
            margin: 5px 0;
        }

        .info-badge {
            background: #e8f4fd;
            color: #0B2A4A;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: center;
            border: 1px solid #b8e0ff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <h1>USCIA AFRIQUE</h1>
                <p>Plateforme de recensement des aumôniers</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first('email') }}
                </div>
            @endif

            @if (session('status'))
                <div class="info-badge">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="votre.email@exemple.com">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           placeholder="Votre mot de passe">
                </div>

                <button type="submit">
                    SE CONNECTER
                </button>
                <!-- Ajoute ce bouton juste après le bouton "SE CONNECTER" -->
<div style="text-align: center; margin-top: 15px;">
    <p style="color: #666; margin-bottom: 10px;">Pas encore inscrit ?</p>
    <a href="{{ route('member.create') }}"
       style="display: inline-block; background: #28a745; color: white; padding: 12px 20px;
              border-radius: 5px; text-decoration: none; font-weight: bold; text-align: center;">
        📝 S'inscrire comme membre
    </a>
</div>
            </form>

            <div class="footer">
                <p>Mot de passe oublié ? Contactez votre supérieur hiérarchique</p>
                <p style="margin-top: 10px; color: #999; font-size: 12px;">
                    Version 1.0 - USCIA Afrique
                </p>
            </div>
        </div>
    </div>
</body>
</html>
