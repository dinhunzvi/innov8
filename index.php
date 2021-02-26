<?php
    require_once './core/initialize.php';

    $page_title = 'Home';
    $js_file = 'index';
    $data_tables = false;
    $stripe = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="welcome">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <div class="card welcome-card">

                        <div class="card-body">

                            <h4>Books</h4>

                            <p>
                                With a wide range of books, you can be assured that we have what you are looking for.
                            </p>

                            <p>
                                From novel, magazines and educational books you are guaranteed we have it. Our books are
                                reasonably priced.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card welcome-card">

                        <div class="card-body">

                            <h4>Stationery</h4>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card welcome-card">

                        <div class="card-body">

                            <h4>Gifts</h4>

                            <p>
                                We have a wide variety of gifts for all occasions. For those we do not have in stock we
                                can order for you upon payment of a 25% deposit.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section id="newest_books">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <h4>Newest books</h4>

                </div>

            </div>

            <div class="row" id="new_books"></div>

        </div>

    </section>

    <section id="best_sellers">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <h4 class="page-title">Best sellers</h4>

                </div>

            </div>

            <div class="row" id="best_selling_books"></div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';




