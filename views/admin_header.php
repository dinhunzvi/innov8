<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap"
              rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
              rel="stylesheet" />

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"
              integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" />
        <?php
            if ( $data_tables ) {
                ?>
                <!-- DataTable css -->
                <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"
                      rel="stylesheet" type="text/css" />
                <?php
            }

            if ( $charts ) {
                ?>
                <!-- chart.js css -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"
                      integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
                <?php
            }
        ?>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="./../images/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="./../images/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="./../images/favicon-16x16.png" />
        <link rel="manifest" href="./../images/site.webmanifest" />

        <!-- custom CSS -->
        <link rel="stylesheet" href="./../css/admin.css" type="text/css" />
        <link rel="stylesheet" href="./../css/common.css" type="text/css" />

        <title></title>
    </head>
    <body>

        <div id="top_row">

            <div class="container-fluid">

                <div class="col-md-12 ml-auto">

                    <ul class="top-menu">

                        <li>

                            <a href="#">
                                Welcome, <i class="fas fa-user"></i> <span id="administrator_name"></span>
                            </a>

                        </li>

                        <li>

                            <a href="change_password.php">
                                <i class="fas fa-edit"></i> Change password
                            </a>

                        </li>

                        <li>

                            <a href="#" id="administrator_sign_out">
                                <i class="fas fa-sign-out-alt"></i> Sign out
                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <nav class="navbar navbar-expand-lg navbar-light" id="navigation">
            <a class="navbar-brand" href="dashboard.php">
                <img src="./../images/logo.jpg" alt="Innov8 Bookshop" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="authors.php">
                            <i class="fas fa-user-alt"></i> Authors
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">
                            <i class="fas fa-file"></i> Book categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="books.php">
                            <i class="fas fa-book"></i> Books
                        </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reports
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>

                        </div>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-users"></i> Users</a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="container-fluid">
