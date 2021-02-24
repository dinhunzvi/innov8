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

        <?php
            if ( $data_tables ) {
                ?>
                <!-- DataTable css -->
                <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"
                      rel="stylesheet" type="text/css" />
                <?php
            }
        ?>

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"
              integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" />
        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png" />
        <link rel="manifest" href="./images/site.webmanifest" />

        <!-- custom CSS -->
        <link rel="stylesheet" href="./css/common.css" type="text/css" />
        <link rel="stylesheet" href="./css/public.css" type="text/css" />

        <title>Innov8 Bookshop - <?php echo $page_title; ?></title>
    </head>
    <body>

        <!-- top starts -->
        <div id="top">

            <!-- container starts -->
            <div class="container">

                <div class="row">

                    <!-- col-md-6 offer starts -->
                    <div class="col-md-6 offer">

                        <!--<a href="#" class="btn btn-success">Welcome : Guest</a>

                        <a href="#">
                            Shopping cart total $100.00 Total items: 2
                        </a>-->

                    </div>
                    <!-- col-md-6 offer ends -->

                    <!-- col-md-6 starts -->
                    <div class="col-md-6">

                        <ul class="menu"><!-- menu starts -->

                            <?php
                                $customer = new Customer;

                                if ( $customer->is_signed_in() ) {
                                    ?>
                                    <li>
                                        <a href="profile.php">
                                            <i class="fas fa-user"></i> My account</a>
                                    </li>

                                    <li>
                                        <a href="change_password.php">
                                            <i class="fas fa-lock"></i> Change password
                                        </a>
                                    </li>

                                    <li>
                                        <a href="sign_in.php" id="customer_sign_out">
                                            <i class="fas fa-sign-out-alt"></i> Sign out
                                        </a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li>
                                        <a href="register.php">
                                            <i class="fas fa-save"></i> Sign up</a>
                                    </li>

                                    <li>
                                        <a href="sign_in.php">
                                            <i class="fas fa-sign-in-alt"></i> Sign in
                                        </a>
                                    </li>
                                    <?php
                                }
                            ?>

                            <li>
                                <a href="shopping_cart.php">
                                    <i class="fas fa-shopping-cart"></i> Shopping cart</a>
                            </li>

                        </ul><!-- menu starts -->

                    </div>
                    <!-- col-md-6 ends -->

                </div>

            </div>
            <!-- container ends -->

        </div>
        <!-- top ends -->

        <nav class="navbar navbar-expand-lg">

            <a class="navbar-brand" href="index.php">
                <img class="img-fluid" src="./images/logo.jpg" alt="Innov8 Bookshop" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-align-justify"></i></span>
            </button>

            <button type="button" class="navbar-toggler" data-target="#search" data-toggle="collapse">
                <span class="navbar-toggler-icon"><i class="fas fa-search"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="book_categories"></div>
                    </li>

                </ul>

                <!--<form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>-->

            </div>

        </nav>

