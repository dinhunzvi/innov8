<?php
    require_once './core/initialize.php';

    $page_title = '';
    $js_file = 'book';
    $data_tables = false;
    $stripe = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="book_details">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <h4 id="book_title"></h4>

                </div>

            </div>

            <div class="row">

                <div class="col-md-8">

                    <div id="book-details-left"></div>

                </div>

                <div class="col-md-4">

                    <div id="book-details-right">

                        <div class="row">

                            <div class="col-md-12" id="error_message"></div>

                        </div>

                        <form method="post" id="add_to_cart">

                            <div class="row">

                                <div class="col-md-6">

                                    <p>$<span id="book_price"></span></p>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <p><span id="quantity_in_stock"></span> left in stock.</p>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group" id="quantity_grp">

                                        <label for="quantity">Quantity</label>
                                        <select id="quantity" name="quantity" class="form-control"></select>
                                        <input type="hidden" id="book_id" name="book_id" />
                                        <input type="hidden" id="price" name="price" />

                                    </div>

                                </div>

                            </div>

                            <button type="submit" id="btnAddCart" class="btn btn-cart">
                                <i class="fas fa-shopping-cart"></i> Add to cart
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4">

                    <h5>Synopsis</h5>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <p id="book_synopsis"></p>

                </div>

            </div>

        </div>

    </section>

    <section id="books_by_author">

        <div class="container">



        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';
