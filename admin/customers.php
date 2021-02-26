<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Customers';
    $js_file = 'customers';
    $data_tables = true;
    $charts = false;
    $pdf_js = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">Customers</h4> <hr />

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover" id="customers">

                    <thead>

                        <tr>

                            <th>First name(s)</th>
                            <th>Last name</th>
                            <th>Email address</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';
