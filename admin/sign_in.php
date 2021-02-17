<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( $user->is_signed_in() ) {
        redirect( 'dashboard.php' );
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Innov8 Administration - Sign in</title>

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap"
              rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
              rel="stylesheet" />

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"
              integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="./../images/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="./../images/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="./../images/favicon-16x16.png" />
        <link rel="manifest" href="./../images/site.webmanifest" />

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="./../css/common.css" rel="stylesheet" type="text/css" />
        <link href="./../css/sign_in.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="text-center">
        <form class="form-signin" id="login_form" method="post">
            <img class="mb-4" src="./../images/logo.jpg" alt="" width="250" height="165">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <div id="error_message"></div>
            <div class="form-group" id="username_grp">

                <input type="text" id="username" class="form-control" placeholder="Username" autocomplete="off" autofocus />

            </div>

            <div class="form-group" id="password_grp">

                <input type="password" id="password" class="form-control" placeholder="Password" />

            </div>

            <button class="btn btn-lg btn-default" type="submit" id="btnSign-in">
                <i class="fas fa-sign-in-alt"></i> Sign in
            </button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
        </form>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
                integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"></script>
        <script src="./../js/common.js" type="text/javascript"></script>
        <script src="./js/sign_in.js" type="text/javascript"></script>
    </body>
</html>
