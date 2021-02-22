<?php
    require_once './core/initialize.php';

    $page_title = 'Innov8 Bookshop - Check Out';
    $stripe = true;
    $data_tables = false;
    $js_file = 'check_out';

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="check-out">

        <div class="container">

            <!-- Display errors returned by checkout session -->
            <div id="payment_response"></div>

        </div>

        <!-- Buy button -->
        <div id="buy_now">
            <button class="stripe-button" id="btnPay">Buy Now</button>
        </div>

    </section>
<?php
    require_once VIEWS_DIR . 'footer.php';