<?php
    require_once './core/initialize.php';

    $page_title = 'Shopping cart';
    $js_file = 'shopping_cart';
    $data_tables = true;
    $stripe = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="cart_details">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <h4 class="page-title"><?php echo $page_title; ?></h4>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <table class="table table-striped table-hover" id="my_cart">

                        <thead>

                            <tr>

                                <th>Author</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

            <div class="row" id="buttons-row">

                <div class="col-md-6">

                    <button type="button" id="btnClear" class="btn btn-danger">
                        <i class="fas fa-times"></i> Clear cart
                    </button>

                    <button type="button" id="btnCheckOut" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i> Check out
                    </button>

                </div>

                <div class="col-md-6 text-right">

                    <p>
                        Cart total: $<span id="cart-total"></span>
                    </p>

                </div>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';
