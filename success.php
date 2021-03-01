<?php
    require_once './core/initialize.php';

    $page_title = 'Payment success';
    $js_file = 'success';
    $stripe = false;
    $data_tables = true;
    $moment = false;
    $charts = false;

    require_once VIEWS_DIR . 'header.php';
?>

    <section id="payment_success">

       <div class="container">

           <div class="row">

               <div class="col-md-6" id="error_message"></div>

           </div>

           <div class="row" id="order_details">

               <div class="col-md-12">

                   <table class="table table-striped table-hover table-responsive-sm" id="order_items">

                       <thead>

                            <tr>

                                <th>Author</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>

                            </tr>

                       </thead>

                   </table>

               </div>

           </div>

       </div>

    </section>

<?php
    require_once VIEWS_DIR . 'footer.php';
