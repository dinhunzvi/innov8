<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Sales';
    $js_file = 'sales';
    $charts = false;
    $data_tables = true;
    $moment = true;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-3">

                <h4 class="page-title">Sales</h4>

                <hr />

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover" id="sales">

                    <thead>

                        <tr>

                            <th>Customer name</th>
                            <th>Sale reference</th>
                            <th>Amount</th>
                            <th>Sale date</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';
