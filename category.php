<?php
    require_once './core/initialize.php';

    $page_title = '';
    $js_file = 'category';
    $data_tables = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="category">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <h4 id="category_title"></h4>

                </div>

            </div>

            <div class="row" id="category_books"></div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';