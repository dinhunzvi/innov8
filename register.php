<?php
    require_once './core/initialize.php';

    $customer = new Customer();

    if ( $customer->is_signed_in() ) {
        redirect( 'index.php' );
    }
?>
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

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
              integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png" />
        <link rel="manifest" href="./images/site.webmanifest" />

        <!-- custom CSS -->
        <link rel="stylesheet" href="./css/common.css" type="text/css" />
        <link rel="stylesheet" href="./css/public.css" type="text/css" />

        <title>Innov8 Bookshop - Customer registration</title>
    </head>
    <body>

        <div class="container">

            <div id="registration_container">

                <div class="row">

                    <div class="col-md-12">

                        <img src="./images/logo.jpg" alt="Innov8 Bookshop" class="img-fluid" />

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <h4>Customer registration</h4>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12" id="error_message"></div>

                </div>

                <form method="post" id="register_form">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group" id="first_name_grp">

                                <input type="text" id="first_name" class="form-control" autocomplete="off" autofocus
                                       placeholder="First name(s)" />

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group" id="last_name_grp">

                                <input type="text" id="last_name" class="form-control" autocomplete="off" autofocus
                                       placeholder="Last name" />

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group" id="email_grp">

                                <input type="email" id="email" class="form-control" placeholder="Email address"
                                       autocomplete="off" />

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group" id="password_grp">

                                <input type="password" id="password" class="form-control" placeholder="Password" />

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group" id="confirm_grp">

                                <input type="password" id="confirm" class="form-control" placeholder="Confirm password" />

                            </div>

                        </div>

                    </div>

                    <button type="submit" id="btnRegister" class="btn btn-blue">
                        <i class="fas fa-save"></i> Register
                    </button>

                    <div class="row">

                        <div class="col-md-6">

                            <p id="link-left">
                                <a href="sign_in.php">Registered already. Sign in here</a>
                            </p>

                        </div>

                        <!--<div class="col-md-6">

                            <p id="link-right">
                                <a href="sign_in.php">Forgot password?</a>
                            </p>

                        </div>-->

                    </div>

                </form>

            </div>

        </div>

        <script src="./js/jquery-3.5.1-min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="./js/common.js" type="text/javascript"></script>
        <script src="js/register.js" type="text/javascript"></script>
    </body>
</html>

