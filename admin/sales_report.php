<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Sales report';
    $js_file = 'sales_report';
    $data_tables = false;
    $moment = false;
    $pdf_js = true;
    $charts = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <canvas id="sales_report_canvas"></canvas>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';