<?php
    require_once './core/initialize.php';

    $page_title = 'Payment success';
    $js_file = 'success';
    $stripe = false;
    $data_tables = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="payment_success">

       <div class="container">

           <div class="row">

               <div class="col-md-6" id="error_message"></div>

           </div>

           <div class="row" id="order_details">

               <div class="col-md-12 table-responsive">

                   <tabel class="table table-striped table-hover" id="order_items"></tabel>

               </div>

           </div>

       </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';
