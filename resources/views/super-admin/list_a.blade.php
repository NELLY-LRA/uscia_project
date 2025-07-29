<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Super Administrator - Member</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <style>
        /*style général de tous les dashboard*/
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        :root {
            --box-shadow: 0 0 10px rgba(0 0 0/18%);
            --blue: #001f3f;
            --gold: #d9af30;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #001f3f;
            /* Bleu nuit */
            color: white;
            position: fixed;
            border-top-right-radius: 30px;
            box-shadow: var(--box-shadow);
        }

        .sidebar h2 {
            text-align: center;
            padding: 15px 0;
            color: #d9af30;

        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 4px;
            margin-bottom: 5px;
            background-color: #c4c2c22f;
            border-top-right-radius: 30px;
            font-family: 'Arial Narrow', Arial, sans-serif;
            font-size: 10px;
            font-style: italic;
            font-kerning: auto;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;

        }

        ul li a {
            color: white;
            text-decoration: none;

        }

        .nextp {
            display: flex;
            margin-left: 40px;
            list-style-type: none;
        }

        .nextp .a2 {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--blue);
            text-align: center;

        }

        .nextp .a2 li {
            padding: 5px;
            font-size: 24px;
            padding-left: 20px;
        }

        .sidebar ul li:hover {
            background-color: #0056b3;
            /* Couleur de survol */
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-bottom: 2px solid #d9af30;
            /* Or */
            position: relative;
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu span {
            margin-right: 15px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border: 2px solid #d9af30;
            /* Or */
            border-radius: 5px;
            padding-top: 3px;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex: 1 1 200px;
            /* Permet aux cartes de s'étendre et de réduire */
            margin: 10px;

        }

        #card-detail a {
            text-decoration: none;
            color: var(--gold);
            font-size: 15px;
        }

        #card-detail {
            background-color: var(--blue);
            padding: 0px;
            height: 20px;
        }

        .card h3 {
            margin: 0;
        }

        .card p {
            font-size: 24px;
            color: #001f3f;
            /* Bleu nuit */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            .cards {
                flex-direction: column;
                align-items: center;
            }

            .card,
            .card1 {
                width: 90%;
                margin: 10px 0;
            }
        }

        i {
            color: #d9af30;
            margin-right: 15px;

        }

        .a1 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 18px;
        }

        input {
            width: 220px;
            height: 20px;
            border-radius: 20px;
            padding: 5px;
            margin-left: 3px;
            border-color: #d9af30;
        }

        .user-menu button {
            height: 32px;
            box-shadow: var(--box-shadow);

            background-color: var(--blue);
            padding: 5px 35px;
            display: inline-block;
            border-radius: 25px;
            color: var(--gold);
            text-transform: capitalize;
            font-family: inherit;
            font-size: 16px;
            cursor: pointer;
            user-select: none;
            position: relative;
            overflow: hidden;

            transition: color 0.3s ease;
            z-index: 2;
            text-decoration: none;
            border: 2px solid var(--gold);
        }

        .user-menu button:hover {
            background-color: var(--gold);
            color: var(--blue);
            border: 1px solid var(--blue);
        }

        /*Style du formulaire membre de la uscia*/

        .form1 h2 {
            text-align: center;
            color: var(--gold);
            margin-top: 20px;
        }

        .form1 {
            background-color: #ffffff;
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
            font-family: 'Segoe UI', sans-serif;

        }

        .form1 .form-section1 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;

        }

        .form1 .form-group {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        .form1 .form-group label {
            margin-bottom: 5px;
            color: #525251;
            font-weight: bold;
        }

        .form1 .form-group input,
        select {
            padding: 10px;
            border: none;
            border-radius: 5px;
            border: 1px var(--gold);
            color: #000;
            font-size: 1em;
            border: 1px solid #d9af30;
            /* Or */
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form1 .form-group input {
            width: 410px;
        }

        .form1 .form-group select {
            width: 432px;
        }

        .form1 button {
            margin-top: 20px;
            margin-left: 95px;
            background-color: var(--blue);
            color: var(--gold);
            border: 1px solid var(--gold);
            border-radius: 5px;
            height: 32px;
            width: 100px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .form1 button:hover {
            background-color: var(--gold);
            color: var(--blue);
            border: 1px solid var(--blue);
        }

        thead,
        tbody,
        tfoot,
        tr,
        td,
        th {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
            margin: 5px;
            margin-left: 10px;
            margin-bottom: 10px;
            cursor: default;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1rem 1rem;
            color: var(--blue);
        }

        .card-body table {
            margin: 10px;
        }

        .card1 {
            width: max-content;
            border: 1 px solid var(--gold);

        }

        .card-header p {
            color: var(--gold);
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="a2">
            <h2>U.S.C.I.A</h2>
            <input type="text" placeholder="Search..." class="search-bar"
                style="box-shadow: 0 0 10px rgba(0 0 0/18%);">
        </div>
        <ul>
            <li style="background-color: #c4c2c2a1; border-top-right-radius: 0px;"><a href="{{ route('dashboard') }}"><i
                        class="fas fa-home"></i>
                    <p class="a1">Dashboard</p>
                </a></li>
            <li><a href="{{ route('add_admin') }}"><i class="fas fa-user-plus"></i>
                    <p class="a1">Add National Admin</p>
                </a></li>
           <li><a href="{{ route('national-admin.index') }}"><i class=" fas fa-users"></i>
                    <p class="a1">View Admins</p>
                </a></li>
            <li><a href="{{ route('pays') }}"><i class="fas fa-globe"></i>
                    <p class="a1">Manage Countries</p>
                </a></li>
            <li><a href="{{ route('membre') }}"><i class="fas fa-user-plus"></i>
                    <p class="a1">Add Member</p>
                </a></li>
            <li><a href="{{ route('liste_m') }}"><i class="fas fa-users"></i>
                    <p class="a1">View members</p>
                </a></li>
        </ul>
    </div>

    <div class="main-content">
        <nav class="navbar">
            <button id="toggle-sidebar"><i class="fas fa-bars"></i></button>
            <h1>Welcome, Super Administrator</h1>
            <div class="user-menu">
                <span><i class="fas fa-user"></i>Profil</span>
             <form method="POST" action="{{route('logout')}}">
                @csrf
            <button type="submit" style="margin-left: 5px;">Logout</button>
            </form>
            </div>
        </nav>

        <section class="form1">
            <div class="card1">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    registred Admin List
                    <input type="text" placeholder="Search..." class="search-bar"
                        style="box-shadow: 0 0 10px rgba(0 0 0/18%); margin-left: 300px;">
                    <button type="submit"
                        style="margin-left: 0px;height: 45px; width:45px;border-radius:50%  ; background-color: #001f3f; color:#d9af30 ; padding: 13px; "><i
                            class="fas fa-search" style="font-size: 18px;"></i></button><br>
                    <button class="btn btn-btn"><a href="{{ route('add_admin') }}" >Add</a></button>

                    <p>_________________________________________________________________________________________________________________________________________________________________________________________________________________________
                    </p>
                </div>
                @if(session('sucess'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Grade</th>
                                <th>Country</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Grade</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->grade ?? 'N/A' }}</td>
                                    <td>{{ $admin->country ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('national-admin.edit', $admin->id) }}">Edit</a>
                                        <form action="{{ route('national-admin.destroy', $admin->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Delete this admin?')">Delete</button>

                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5">No National Admins Found</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>

    </script>
</body>

</html>
