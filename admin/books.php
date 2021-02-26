<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Books';
    $js_file = 'books';
    $charts = false;
    $data_tables = true;
    $moment = false;
    $pdf_js = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section>

        <div class="row">

            <div class="col-md-4">

                <h4 class="page-title">Book details</h4>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4" id="error_message"></div>

        </div>

        <form method="post" id="book_details" enctype="multipart/form-data">

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="category_grp">

                        <select name="category" id="category" class="form-control"></select>
                        <input type="hidden" id="book_id" name="book_id" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="author_grp">

                        <select name="author" id="author" class="form-control"></select>

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="title_grp">

                        <input type="text" name="title" id="title" class="form-control" placeholder="Book title"
                               autocomplete="off" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="price_grp">

                        <input type="text" name="price" id="price" autocomplete="off" class="form-control"
                               placeholder="Price" />

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="synopsis_grp">

                        <textarea id="synopsis" name="synopsis" class="form-control"
                                  placeholder="Synopsis(description)"></textarea>

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="quantity_grp">

                        <input type="text" id="quantity" name="quantity" class="form-control" autocomplete="off"
                               placeholder="Quantity in stock" />

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-4">

                    <div class="form-group" id="book_cover_grp">

                        <input type="file" id="book_cover" name="book_cover" class="form-control-file" />

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

                <table class="table table-striped table-hover" id="books">

                    <thead>

                        <tr>

                            <th>Book category</th>
                            <th>Author</th>
                            <th>Book title</th>
                            <th>Book cover</th>
                            <th>Price</th>
                            <th>Quantity</th>
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