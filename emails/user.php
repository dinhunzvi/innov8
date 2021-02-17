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

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="http://www.dnptransport.com/innov8/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="http://www.dnptransport.com/innov8/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="http://www.dnptransport.com/innov8/favicon-16x16.png" />
        <link rel="manifest" href="http://www.dnptransport.com/innov8/site.webmanifest" />

        <!-- custom CSS -->
        <link rel="stylesheet" href="http://www.dnptransport.com/innov8/email.css" type="text/css" />

        <title>Innov8 Bookshop User Registration</title>
    </head>
    <body>

        <div class="container">

            <div class="row">

                <div id="email-header">

                    <div class="col-md-12">

                        <img src="http://www.dnptransport.com/innov8/logo.jpg" alt="Innov8 Bookshop" class="img-fluid" />

                    </div>

                </div>


            </div>

            <div class="row">

                <div class="col-md-12">

                    <p>Welcome, <strong><?php echo $data['name']; ?></strong></p>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <p>
                        Welcome, <?php echo $data['name']; ?> to Innov8 Bookshop. This email contains your credentials for accessing the Innov8
                        Bookshop Content Management System(CMS). Use the credentials below to sign in.<br /><br />
                        Username: <?php echo $data['username']; ?> <br />
                        Password: <?php echo $data['password']; ?>
                    </p>

                    <p>
                        Click <a href="http://localhost/innov8/admin/sign_in.php" class="btn-default">
                            <i class="fas fa-sign-in-alt"></i> here</a> to sign in to the Content Management System. You
                        are encouraged to change the password immediately. You must use a strong password that you can
                        easily remember.
                    </p>

                    <p>

                        Innov8 Bookshop IT Support Team
                    </p>

                </div>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
                integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"></script>
    </body>
</html>
