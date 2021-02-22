<?php
    require_once './core/initialize.php';

    $page_title = 'Payment success';
    $js_file = 'success';
    $stripe = false;
    $data_tables = false;

    require_once VIEWS_DIR . 'header.php';
?>

<?php
    require_once VIEWS_DIR . 'footer.php';
