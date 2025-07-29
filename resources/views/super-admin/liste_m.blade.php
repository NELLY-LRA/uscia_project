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
            <li style="background-color: #c4c2c2a1; border-top-right-radius: 0px;"><a
                    href="{{ route('dashboard') }}"><i class="fas fa-home"></i>
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
            <div class="card1">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Registred Member List
                    <input type="text" placeholder="Search..." class="search-bar"
                        style="box-shadow: 0 0 10px rgba(0 0 0/18%); margin-left: 300px;">
                    <button type="submit"
                        style="margin-left: 0px;height: 45px; width:45px;border-radius:50%  ; background-color: #001f3f; color:#d9af30 ; padding: 13px; "><i
                            class="fas fa-search" style="font-size: 18px;"></i></button>
                    <p>_________________________________________________________________________________________________________________________________________________________________________________________________________________________
                    </p>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Country</th>
                                <th>Age</th>
                                <th>Email</th>
                                <th>Num Cni</th>
                                <th>Analysis</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Country</th>
                                <th>Age</th>
                                <th>Email</th>
                                <th>Num Cni</th>
                                <th>Analysis</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008/10/16</td>
                                <td>$470,600</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012/12/18</td>
                                <td>$313,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010/03/17</td>
                                <td>$385,750</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012/11/27</td>
                                <td>$198,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010/06/09</td>
                                <td>$725,000</td>
                                <td><button>Edit</button></td>
                            </tr>
                            <tr>
                                <td>Gloria Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009/04/10</td>
                                <td>$237,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Dai Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012/09/26</td>
                                <td>$217,500</td>
                                <td><button> Edit</button></td>
                            </tr>

                            <tr>
                                <td>Jenette Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011/09/03</td>
                                <td>$345,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Yuri Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009/06/25</td>
                                <td>$675,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Doris Wilder</td>
                                <td>Sales Assistant</td>
                                <td>Sidney</td>
                                <td>23</td>
                                <td>2010/09/20</td>
                                <td>$85,600</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Angelica Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2009/10/09</td>
                                <td>$1,200,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Gavin Joyce</td>
                                <td>Developer</td>
                                <td>Edinburgh</td>
                                <td>42</td>
                                <td>2010/12/22</td>
                                <td>$92,575</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Jennifer Chang</td>
                                <td>Regional Director</td>
                                <td>Singapore</td>
                                <td>28</td>
                                <td>2010/11/14</td>
                                <td>$357,650</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Brenden Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Fiona Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td>San Francisco</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td>$850,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Shou Itou</td>
                                <td>Regional Marketing</td>
                                <td>Tokyo</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td>$163,000</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Michelle House</td>
                                <td>Integration Specialist</td>
                                <td>Sidney</td>
                                <td>37</td>
                                <td>2011/06/02</td>
                                <td>$95,400</td>
                                <td><button> Edit</button></td>
                            </tr>
                            <tr>
                                <td>Suki Burks</td>
                                <td>Developer</td>
                                <td>London</td>
                                <td>53</td>
                                <td>2009/10/22</td>
                                <td>$114,500</td>
                                <td><button> Edit</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="D:\MES APPLI WEB\USCIA_FRONT\Superadmin\script.js"></script>
</body>

</html>
