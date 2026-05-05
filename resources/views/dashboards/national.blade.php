<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin National - USCIA Afrique</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .header {
            background: #0B2A4A;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 20px;
            color: #D4AF37;
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header .user-info span {
            color: white;
        }

        .header .logout-btn {
            background: #D4AF37;
            color: #0B2A4A;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .country-badge {
            background: #D4AF37;
            color: #0B2A4A;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            color: #0B2A4A;
            font-size: 32px;
            font-weight: bold;
        }

        .section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            color: #0B2A4A;
            font-size: 18px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 10px;
            background: #f8f9fa;
            color: #666;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .badge {
            background: #e8f4fd;
            color: #0B2A4A;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #0B2A4A;
            color: white;
        }

        .btn-secondary {
            background: #D4AF37;
            color: #0B2A4A;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>USCIA AFRIQUE - Admin National</h1>
        <div class="user-info">
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="country-badge">
            {{ Auth::user()->country->name ?? 'Pays non défini' }}
        </div>

        <div class="action-buttons">
            <a href="#" class="btn btn-primary">➕ Ajouter un membre</a>
            <a href="#" class="btn btn-secondary">👥 Gérer les admins régionaux</a>
            <a href="#" class="btn btn-secondary">📊 Exporter les données</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Membres</h3>
                <div class="number">{{ $stats['total_members'] ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Régions</h3>
                <div class="number">{{ $stats['total_regions'] ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Admins Régionaux</h3>
                <div class="number">{{ $stats['total_regional_admins'] ?? 0 }}</div>
            </div>
        </div>

        <div class="section">
            <h2>Membres par région</h2>
            <table>
                <thead>
                    <tr>
                        <th>Région</th>
                        <th>Nombre de membres</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['members_by_region'] ?? [] as $region)
                        <tr>
                            <td>{{ $region->name }}</td>
                            <td><span class="badge">{{ $region->members_count }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align: center; color: #999;">Aucune région trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Derniers membres inscrits</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro USCIA</th>
                        <th>Région</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_members'] ?? [] as $member)
                        <tr>
                            <td>{{ $member->last_name }}</td>
                            <td>{{ $member->first_name }}</td>
                            <td><span class="badge">{{ $member->uscia_number }}</span></td>
                            <td>{{ $member->region->name ?? 'N/A' }}</td>
                            <td>{{ $member->created_at->format('d/m/Y') }}</td>
                            <td class="actions" style="display: flex; gap: 5px;">
                                <a href="{{ route('members.show', $member->id) }}"
                                    style="background: #0B2A4A; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 12px;">
                                    Voir
                                </a>
                                <a href="{{ route('members.edit', $member->id) }}"
                                    style="background: #D4AF37; color: #0B2A4A; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 12px;">
                                    Modifier
                                </a>
                                @if (Auth::user()->isNationalAdmin())
                                    <a href="{{ route('members.transfer.form', $member->id) }}"
                                        style="background: #28a745; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 12px;">
                                        Transférer
                                    </a>
                                @endif
                            </td>
                        </tr>
                         @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="action-buttons" style="margin-bottom: 20px;">
            <a href="{{ route('member.create') }}" class="btn btn-primary"
                style="background: #0B2A4A; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                ➕ Ajouter un membre
            </a>
            <a href="{{ route('admins.regional.index') }}" class="btn btn-secondary"
                style="background: #D4AF37; color: #0B2A4A; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                👥 Gérer les Admins Régionaux
            </a>
            <a href="#" class="btn btn-secondary"
                style="background: #D4AF37; color: #0B2A4A; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                📊 Exporter les données
            </a>
        </div>
    </div>
</body>

</html>
