<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Categories';
    $js_file = 'categories';
    $data_tables = true;
    $charts = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">Book category details</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <form method="post" id="category_details">

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="category_name_grp">

                        <input type="text" id="category_name" name="category_name" class="form-control"
                               autocomplete="off" placeholder="Category name" />
                        <input type="hidden" id="category_id" name="category_id" />

                    </div>

                </div>

            </div>

            <button type="submit" id="btnSave" class="btn btn-default">
                <i class="fas fa-save"></i> Save
            </button>

        </form>

    </section>

    <section>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover" id="categories">

                    <thead>

                        <tr>

                            <th>Book category</th>
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