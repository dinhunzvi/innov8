<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        // redirect( 'sign_in.php' );
    }

    $page_title = 'Change password';
    $js_file = 'change_password';
    $data_tables = false;
    $charts = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">Change password</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <p>
                    Please ensure you have chosen a strong password when changing your password. It's recommended that
                    your password must have between 8 and 20 characters. It also must have at least 1 upper case
                    character, one numeric character and any one of the following special characters, *[@#\-_$%^&+=ยง!.
                </p>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <form method="post" id="user_password">

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="current_grp">

                        <input type="password" id="current" name="current" class="form-control"
                               placeholder="Current password" />

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="password_grp">

                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="New password" />

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="confirm_grp">

                        <input type="password" id="confirm" name="confirm" class="form-control"
                               placeholder="Confirm new password" />

                    </div>

                </div>

            </div>

            <button type="submit" id="btnChange" class="btn btn-default">
                <i class="fas fa-lock"></i> Change password
            </button>

        </form>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';