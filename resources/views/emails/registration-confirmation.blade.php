<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation d'inscription - USCIA</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden;">
        <div style="background: #0B2A4A; padding: 20px; text-align: center;">
            <h1 style="color: #D4AF37; margin: 0;">USCIA AFRIQUE</h1>
        </div>

        <div style="padding: 30px;">
            <h2 style="color: #0B2A4A;">Félicitations {{ $member->first_name }} {{ $member->last_name }} !</h2>

            <p>Votre inscription à l'USCIA Afrique a été enregistrée avec succès.</p>

            <div style="background: #f0f4f8; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <p><strong>📋 Numéro USCIA :</strong> {{ $member->uscia_number }}</p>
                <p><strong>📍 Pays :</strong> {{ $member->country->name ?? '-' }}</p>
                <p><strong>📍 Région :</strong> {{ $member->region->name ?? '-' }}</p>
                <p><strong>⭐ Grade :</strong> {{ $member->grade_name }}</p>
            </div>

            <p>Un administrateur de votre région prendra contact avec vous prochainement.</p>

            <p>Bienvenue dans la communauté USCIA !</p>

            <hr style="margin: 30px 0;">

            <p style="color: #666; font-size: 12px;">Ce message est automatique, merci de ne pas y répondre.</p>
        </div>

        <div style="background: #f9f9f9; padding: 15px; text-align: center; font-size: 12px; color: #999;">
            <p>© {{ date('Y') }} USCIA Afrique - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
