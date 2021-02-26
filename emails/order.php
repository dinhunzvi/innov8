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

        <title>Innov8 Bookshop Order confirmation</title>
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

                    <p>Hello, <strong><?php echo $data['name']; ?></strong></p>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <p>
                        Your order confirmation details for order: #<span><?= $data['reference'] ?></span>
                    </p>

                </div>

            </div>

            <div class="row table-responsive">

                <div class="col-12">

                    <table class="table table-striped table-hover">

                        <thead>

                            <tr>

                                <th>Author</th>
                                <th>Book title</th>
                                <th>Price($)</th>
                                <th>Quantity</th>
                                <th>Total price</th>

                            </tr>

                        </thead>
                        <?php
                            foreach ( $data['order'] as $order_item ) {
                                ?>
                                <<tr>
                                    <td><?= $order_item['author'] ?></td>
                                    <td><?= $order_item['title'] ?></td>
                                    <td>$<?= $order_item['price'] ?></td>
                                    <td><?= $order_item['quantity'] ?></td>
                                    <td>$<?= $order_item['total'] ?></td>
                                </tr>
                                <?php
                            }

                        ?>

                    </table>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <h4>Total amount: $<?= $data['total'] ?></h4>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4">

                    <p>
                        Thank you for shopping with us.
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

