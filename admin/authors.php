<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Authors';
    $js_file = 'authors';
    $charts = false;
    $data_tables = true;
    $moment = false;
    $pdf_js = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">Author details</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <form method="post" id="author_details">

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="first_name_grp">

                        <input type="text" id="first_name" name="first_name" class="form-control" autocomplete="off"
                               placeholder="First name(s)" />
                        <input type="hidden" id="author_id" name="author_id" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="last_name_grp">

                        <input type="text" id="last_name" name="last_name" class="form-control" autocomplete="off"
                               placeholder="Last name" />

                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-default" id="btnSave">
                <i class="fas fa-save"></i> Save
            </button>

        </form>

    </section>

    <section>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover" id="authors">

                    <thead>

                        <tr>

                            <th>Author name</th>
                            <th>Created by</th>
                            <th>Deleted</th>
                            <th>Delete</th>
                            <th>Edit</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';

