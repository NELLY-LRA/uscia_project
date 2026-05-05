<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Admins Nationaux - USCIA</title>
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
        .header h1 { font-size: 20px; color: #D4AF37; }
        .logout-btn {
            background: #D4AF37;
            color: #0B2A4A;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .container { padding: 20px; max-width: 1200px; margin: 0 auto; }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: #0B2A4A; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; color: #666; }
        .badge {
            background: #e8f4fd;
            color: #0B2A4A;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
        }
        .badge-active { background: #d4edda; color: #155724; }
        .badge-inactive { background: #f8d7da; color: #721c24; }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .actions { display: flex; gap: 5px; }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>USCIA AFRIQUE - Gestion des Admins Nationaux</h1>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="top-bar">
            <h2>Liste des Admins Nationaux</h2>
            <a href="{{ route('admins.national.create') }}" class="btn btn-success">+ Nouvel Admin National</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>Statut</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                <tr>
                    <td><strong>{{ $admin->name }}</strong></td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->country->name ?? '-' }}</td>
                    <td>
                        @if($admin->is_active)
                            <span class="badge badge-active">Actif</span>
                        @else
                            <span class="badge badge-inactive">Inactif</span>
                        @endif
                    </td>
                    <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('admins.national.edit', $admin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admins.national.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Supprimer cet admin ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999; padding: 40px;">
                        Aucun admin national pour le moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $admins->links() }}
        </div>

        <div style="margin-top: 20px;">
            <a href="{{ route('dashboard.super-admin') }}" class="btn btn-primary">← Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>
