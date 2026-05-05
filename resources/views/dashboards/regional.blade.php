<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Régional - USCIA Afrique</title>
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

        .region-badge {
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
            flex-wrap: wrap;
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

        .gender-stats {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .gender-item {
            flex: 1;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .gender-item.male {
            border-left: 4px solid #0B2A4A;
        }

        .gender-item.female {
            border-left: 4px solid #D4AF37;
        }

        .gender-item .count {
            font-size: 24px;
            font-weight: bold;
            color: #0B2A4A;
        }

        .gender-item .label {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>USCIA AFRIQUE - Admin Régional</h1>
        <div class="user-info">
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="region-badge">
            {{ Auth::user()->region->name ?? 'Région non définie' }} -
            {{ Auth::user()->country->name ?? '' }}
        </div>

        <div class="action-buttons">
            <a href="#" class="btn btn-primary">➕ Ajouter un membre</a>
            <a href="#" class="btn btn-secondary">📄 Gérer les documents</a>
            <a href="#" class="btn btn-secondary">🔍 Rechercher</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Membres</h3>
                <div class="number">{{ $stats['total_members'] }}</div>
            </div>
        </div>

        <div class="section">
            <h2>Répartition par sexe</h2>
            <div class="gender-stats">
                <div class="gender-item male">
                    <div class="count">{{ $stats['members_by_gender']['male'] }}</div>
                    <div class="label">Hommes</div>
                </div>
                <div class="gender-item female">
                    <div class="count">{{ $stats['members_by_gender']['female'] }}</div>
                    <div class="label">Femmes</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Derniers membres inscrits</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro USCIA</th>
                        <th>Grade</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_members'] as $member)
                        <tr>
                            <td>{{ $member->last_name }}</td>
                            <td>{{ $member->first_name }}</td>
                            <td><span class="badge">{{ $member->uscia_number }}</span></td>
                            <td>{{ $member->grade_name }}</td>
                            <td>{{ $member->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #999;">Aucun membre pour le moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>📋 Liste complète des membres</h2>

            <div style="margin-bottom: 20px;">
                <input type="text" id="search" placeholder="🔍 Rechercher par nom, prénom ou numéro USCIA..."
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 5px;">
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>N° USCIA</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Grade</th>
                            <th>Téléphone</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td><span class="badge">{{ $member->uscia_number }}</span></td>
                                <td><strong>{{ $member->last_name }}</strong></td>
                                <td>{{ $member->first_name ?? '-' }}</td>
                                <td>{{ $member->grade_name }}</td>
                                <td>{{ $member->phone ?? '-' }}</td>
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #999; padding: 40px;">
                                    Aucun membre inscrit dans votre région pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $members->links() }}
            </div>
        </div>

        <script>
            // Recherche en temps réel
            document.getElementById('search').addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
    </div>
</body>

</html>
