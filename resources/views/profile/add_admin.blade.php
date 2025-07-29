<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Super Administrator - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="margin-left: 5px;">Logout</button>
                </form>
            </div>
        </nav>
        <section class="form1">
            <h2>National Admin Form - U.S.C.I.A</h2>
            <form action="{{route('national-admin.store')}}" method="POST">
                @csrf
                <div class="form-section1">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country">
                            <option value="">Choose a country</option>
                            <option value="Algerie">Algerie</option>
                            <option value="Angola">Angola</option>
                            <option value="Benin">Benin</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                            <option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mali">Mali</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Réunion">Réunion</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Sudan">Sudan</option>
                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                            <option value="Togo">Togo</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" name="grade" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password"
                            name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" value="save">
                       Create
                </button>

            </form>
        </section>
        </section>

    </div>

    <script src="script.js"></script>
</body>

</html>-->

@extends('layouts.partials')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5 offset-3">
            <div class="card-header py-3 justify-content-center">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-dark">Add Admin Account</h6>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('createAdmin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="form-control @error('last_name') is-invalid @enderror" id="last_name">
                        @error('last_name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                      <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="form-control @error('first_name') is-invalid @enderror" id="first_name">
                        @error('first_name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="email">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                     <div class="mb-3">
                        <label for="grade" class="form-label">Grade</label>
                        <input type="text" name="grade" value="{{ old('grade') }}"
                            class="form-control @error('grade') is-invalid @enderror" id="grade">
                        @error('grade')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                     <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select name="country" value="{{ old('country') }}"
                            class="form-control @error('country') is-invalid @enderror" id="country">
                        @error('country')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                            <option value="">Choose a country</option>
                            <option value="Algerie">Algerie</option>
                            <option value="Angola">Angola</option>
                            <option value="Benin">Benin</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                            <option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mali">Mali</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                             <option value="Réunion">Réunion</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                             <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                             <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Sudan">Sudan</option>
                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                            <option value="Togo">Togo</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Uganda">Uganda</option>
                             <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror" id="phone">
                        @error('phone')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password">
                        @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                        <input type="password" name="confirmpassword"
                            class="form-control @error('confirmpassword') is-invalid @enderror" id="confirmpassword">
                        @error('confirmpassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Create" class="btn btn-primary w-100">
                        </div>
                        <div class="col">
                            <a href="{{ route('dashboard')}}" class="btn btn-secondary w-100">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

