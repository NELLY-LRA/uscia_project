<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Super Administrator</title>
    <link href="public\assets\css\styles.css" rel="stylesheet" />
    <link href="public\assets\css\style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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

        .row .card {
            --bs-card-spacer-y: 1rem;
            --bs-card-spacer-x: 1rem;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-border-width: 1px;
            --bs-card-border-color: var(--bs-border-color-translucent);
            --bs-card-border-radius: 0.375rem;
            --bs-card-box-shadow: ;
            --bs-card-inner-border-radius: calc(0.375rem - 1px);
            --bs-card-cap-padding-y: 0.5rem;
            --bs-card-cap-padding-x: 1rem;
            --bs-card-cap-bg: rgba(0, 0, 0, 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: ;
            --bs-card-bg: #fff;
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 0.75rem;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: var(--bs-card-border-width) solid var(--bs-card-border-color);
            border-radius: var(--bs-card-border-radius);
        }

        .row .card>hr {
            margin-right: 0;
            margin-left: 0;
        }

        .row.card>.list-group {
            border-top: inherit;
            border-bottom: inherit;
        }

        .row .card>.list-group:first-child {
            border-top-width: 0;
            border-top-left-radius: var(--bs-card-inner-border-radius);
            border-top-right-radius: var(--bs-card-inner-border-radius);
        }

        .row .card>.list-group:last-child {
            border-bottom-width: 0;
            border-bottom-right-radius: var(--bs-card-inner-border-radius);
            border-bottom-left-radius: var(--bs-card-inner-border-radius);
        }

        .row .card>.card-header+.list-group,
        .row .card>.list-group+.card-footer {
            border-top: 0;
        }

        .row .card-body {
            flex: 1 1 auto;
            padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
            color: var(--bs-card-color);
        }

        .row .card-title {
            margin-bottom: var(--bs-card-title-spacer-y);
        }

        .row .card-subtitle {
            margin-top: calc(-0.5 * var(--bs-card-title-spacer-y));
            margin-bottom: 0;
        }

        .row .card-text:last-child {
            margin-bottom: 0;
        }

        .row .card-link+.card-link {
            margin-left: var(--bs-card-spacer-x);
        }

        .row .card-header {
            padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
            margin-bottom: 0;
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);
        }

        .row .card-header:first-child {
            border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0;
        }

        .row .card-footer {
            padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-top: var(--bs-card-border-width) solid var(--bs-card-border-color);
        }

        .row .card-footer:last-child {
            border-radius: 0 0 var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius);
        }

        .row .card-header-tabs {
            margin-right: calc(-0.5 * var(--bs-card-cap-padding-x));
            margin-bottom: calc(-1 * var(--bs-card-cap-padding-y));
            margin-left: calc(-0.5 * var(--bs-card-cap-padding-x));
            border-bottom: 0;
        }

        .row .card-header-tabs .nav-link.active {
            background-color: var(--bs-card-bg);
            border-bottom-color: var(--bs-card-bg);
        }

        .row .card-header-pills {
            margin-right: calc(-0.5 * var(--bs-card-cap-padding-x));
            margin-left: calc(-0.5 * var(--bs-card-cap-padding-x));
        }

        .row .card-img-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: var(--bs-card-img-overlay-padding);
            border-radius: var(--bs-card-inner-border-radius);
        }

        .row .card-img,
        .row .card-img-top,
        .row .card-img-bottom {
            width: 100%;
        }

        .row .card-img,
        .row .card-img-top {
            border-top-left-radius: var(--bs-card-inner-border-radius);
            border-top-right-radius: var(--bs-card-inner-border-radius);
        }

        .row .card-img,
        .row .card-img-bottom {
            border-bottom-right-radius: var(--bs-card-inner-border-radius);
            border-bottom-left-radius: var(--bs-card-inner-border-radius);
        }

        .row .card-group>.card {
            margin-bottom: var(--bs-card-group-margin);
        }

        @media (min-width: 576px) {
            .row .card-group {
                display: flex;
                flex-flow: row wrap;
            }

            .row .card-group>.card {
                flex: 1 0 0%;
                margin-bottom: 0;
            }

            .row .card-group>.card+.card {
                margin-left: 0;
                border-left: 0;
            }

            .row .card-group>.card:not(:last-child) {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .row .card-group>.card:not(:last-child) .card-img-top,
            .row .card-group>.card:not(:last-child) .card-header {
                border-top-right-radius: 0;
            }

            .row .card-group>.card:not(:last-child) .card-img-bottom,
            .row .card-group>.card:not(:last-child) .card-footer {
                border-bottom-right-radius: 0;
            }

            .row .card-group>.card:not(:first-child) {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

            .row .card-group>.card:not(:first-child) .card-img-top,
            .row .card-group>.card:not(:first-child) .card-header {
                border-top-left-radius: 0;
            }

            .row .card-group>.card:not(:first-child) .card-img-bottom,
            .row .card-group>.card:not(:first-child) .card-footer {
                border-bottom-left-radius: 0;
            }
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

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
         <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily =
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10",
                    "Mar 11", "Mar 12", "Mar 13"
                ],
                datasets: [{
                    label: "Sessions",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651,
                        31984, 38451
                    ],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 40000,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily =
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [{
                    label: "Revenue",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: [4215, 5312, 6251, 7841, 9821, 14984],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 15000,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });

        /*!
         * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
         * Copyright 2013-2023 Start Bootstrap
         * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
         */
        //
        // Scripts
        //

        window.addEventListener('DOMContentLoaded', event => {

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                        'sb-sidenav-toggled'));
                });
            }

        });
    </script>
</body>

</html>
