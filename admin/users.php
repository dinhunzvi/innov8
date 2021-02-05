<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        // redirect( 'sign_in.php' );
    }

    $page_title = 'Users';
    $js_file = 'users';
    $data_tables = true;
    $charts = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">User details</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <form method="post" id="user_details">

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="first_name_grp">

                        <input type="text" id="first_name" name="first_name" class="form-control" autocomplete="off"
                               placeholder="First name(s)" />
                        <input type="hidden" id="user_id" name="user_id" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="last_name_grp">

                        <input type="text" id="last_name" name="last_name" class="form-control" autocomplete="off"
                               placeholder="Last name" />

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="email_grp">

                        <input type="text" name="email" id="email" class="form-control" autocomplete="off"
                               placeholder="Email address" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="username_grp">

                        <input type="text" id="username" name="username" class="form-control" autocomplete="off"
                               placeholder="Username" />

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

                <table class="table table-striped table-hover" id="users">

                    <thead>

                        <tr>

                            <th>First name(s)</th>
                            <th>Last name</th>
                            <th>Username</th>
                            <th>Email address</th>
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