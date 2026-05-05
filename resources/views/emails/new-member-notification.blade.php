<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nouveau membre - USCIA</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden;">
        <div style="background: #0B2A4A; padding: 20px; text-align: center;">
            <h1 style="color: #D4AF37; margin: 0;">USCIA AFRIQUE</h1>
        </div>

        <div style="padding: 30px;">
            <h2 style="color: #0B2A4A;">Bonjour {{ $admin->name }},</h2>

            <p>Un nouveau membre vient de s'inscrire dans votre région !</p>

            <div style="background: #f0f4f8; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <h3 style="color: #0B2A4A; margin-top: 0;">Informations du nouveau membre :</h3>
                <p><strong>👤 Nom :</strong> {{ $member->last_name }} {{ $member->first_name }}</p>
                <p><strong>📧 Email :</strong> {{ $member->email ?? 'Non renseigné' }}</p>
                <p><strong>📞 Téléphone :</strong> {{ $member->phone ?? 'Non renseigné' }}</p>
                <p><strong>📋 Numéro USCIA :</strong> {{ $member->uscia_number }}</p>
                <p><strong>⭐ Grade :</strong> {{ $member->grade_name }}</p>
                <p><strong>📍 Région :</strong> {{ $member->region->name ?? '-' }}</p>
            </div>

            <p>Connectez-vous à la plateforme pour consulter la fiche complète :</p>
            <p style="text-align: center;">
                <a href="{{ url('/dashboard/' . ($admin->isRegionalAdmin() ? 'regional' : ($admin->isNationalAdmin() ? 'national' : 'super-admin'))) }}"
                   style="background: #D4AF37; color: #0B2A4A; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Voir le membre
                </a>
            </p>

            <hr style="margin: 30px 0;">

            <p style="color: #666; font-size: 12px;">Ce message est automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
