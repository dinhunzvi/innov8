<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Dashboard';
    $js_file = 'dashboard';
    $charts = true;
    $data_tables = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>


<?php
    require_once VIEWS_DIR . 'admin_footer.php';

