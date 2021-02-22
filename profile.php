<?php
    require_once './core/initialize.php';

    $customer = new Customer();

    if ( !$customer->is_signed_in() ) {
        redirect( 'index.php' );
    }

    $page_title = 'Customer profile';
    $js_file = 'profile';
    $data_tables = false;
    $stripe = false;

    require_once VIEWS_DIR . 'header.php';
?>

<?php
    require_once VIEWS_DIR . 'footer.php';
