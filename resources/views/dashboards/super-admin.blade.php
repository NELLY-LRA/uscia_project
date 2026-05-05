<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - USCIA Afrique</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        .recent-list {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .recent-list h2 {
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">
        <h1>USCIA AFRIQUE - Super Administrateur</h1>
        <div class="user-info">
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Membres</h3>
                <div class="number">{{ $stats['total_members'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Pays</h3>
                <div class="number">{{ $stats['total_countries'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Administrateurs</h3>
                <div class="number">{{ $stats['total_admins'] }}</div>
            </div>
        </div>

        <div class="recent-list">
            <h2>Derniers membres inscrits</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro USCIA</th>
                        <th>Pays</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_members'] as $member)
                    <tr>
                        <td>{{ $member->last_name }}</td>
                        <td>{{ $member->first_name }}</td>
                        <td><span class="badge">{{ $member->uscia_number }}</span></td>
                        <td>{{ $member->country->name ?? 'N/A' }}</td>
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

        <div class="action-buttons" style="margin-bottom: 20px;">
    <a href="{{ route('admins.national.index') }}" class="btn btn-primary" style="background: #0B2A4A; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
        👥 Gérer les Admins Nationaux
    </a>
    <a href="#" class="btn btn-secondary" style="background: #D4AF37; color: #0B2A4A; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
        📊 Statistiques
    </a>
</div>
<!-- Graphiques -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Graphique par pays -->
    <div class="section">
        <h3>📊 Membres par pays (Top 10)</h3>
        <canvas id="countriesChart" style="max-height: 300px;"></canvas>
    </div>

    <!-- Graphique par grade -->
    <div class="section">
        <h3>📊 Membres par grade</h3>
        <canvas id="gradesChart" style="max-height: 300px;"></canvas>
    </div>
</div>

<!-- Graphique évolution -->
<div class="section" style="margin-bottom: 30px;">
    <h3>📈 Évolution des inscriptions (12 derniers mois)</h3>
    <canvas id="evolutionChart" style="max-height: 300px;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique par pays
    const countriesCtx = document.getElementById('countriesChart').getContext('2d');
    new Chart(countriesCtx, {
        type: 'bar',
        data: {
            labels: @json($membersByCountry->pluck('name')),
            datasets: [{
                label: 'Nombre de membres',
                data: @json($membersByCountry->pluck('members_count')),
                backgroundColor: '#0B2A4A',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Graphique par grade
    const gradesCtx = document.getElementById('gradesChart').getContext('2d');
    new Chart(gradesCtx, {
        type: 'pie',
        data: {
            labels: @json($membersByGrade->pluck('name')),
            datasets: [{
                data: @json($membersByGrade->pluck('members_count')),
                backgroundColor: ['#0B2A4A', '#D4AF37', '#2E7D32', '#C62828', '#1565C0', '#6A1B9A', '#E65100']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Graphique évolution
    const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
    new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: @json($membersByMonth->pluck('month')),
            datasets: [{
                label: 'Nouvelles inscriptions',
                data: @json($membersByMonth->pluck('count')),
                borderColor: '#0B2A4A',
                backgroundColor: 'rgba(11, 42, 74, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
</script>
    </div>
</body>
</html>
