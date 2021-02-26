<?php
    require_once './../core/initialize.php';

    $user = new User;

    if ( !$user->is_signed_in() ) {
        redirect( 'sign_in.php' );
    }

    $page_title = 'Dashboard';
    $js_file = 'dashboard';
    $charts = true;
    $data_tables = false;
    $moment = false;

    require_once VIEWS_DIR . 'admin_header.php';
?>

    <section id="card-statistics">

        <div class="container-fluid">

            <div class="row">

               <div class="col-md-3">

                   <div class="card statistics-card">

                       <div class="card-body">

                           <div class="d-flex justify-content-between">

                               <i class="fas fa-money-check fa-3x text-success"></i>

                               <div class="text-right">

                                   <h5>Total sales</h5>

                                   $<span id="total_sales"></span>

                               </div>

                           </div>

                       </div>

                       <div class="card-footer">

                           <i class="fas fa-sync mb-3"></i> Refresh

                       </div>

                   </div>

               </div>

               <div class="col-md-3">

                   <div class="card statistics-card">

                       <div class="card-body">

                           <div class="d-flex justify-content-between">

                               <i class="fas fa-folder text-success fa-3x"></i>

                               <div class="text-right">

                                   <h5># of orders</h5>

                                   <span id="number_sales"></span>

                               </div>

                           </div>

                       </div>

                       <div class="card-footer">

                           <i class="fas fa-sync mb-3"></i> Refresh

                       </div>

                   </div>

               </div>

               <div class="col-md-3">

                   <div class="card statistics-card">

                       <div class="card-body">

                           <div class="d-flex justify-content-between">

                               <i class="fas fa-book-reader fa-3x text-success"></i>

                               <div class="text-right">

                                   <h5>Customers</h5>

                                   <span id="customers"></span>

                               </div>

                           </div>

                       </div>

                       <div class="card-footer">

                           <i class="fas fa-sync mb-3"></i> Refresh

                       </div>

                   </div>

               </div>

               <div class="col-md-3">

                   <div class="card statistics-card">

                       <div class="card-body">

                           <div class="d-flex justify-content-between">

                               <i class="fas fa-book fa-3x text-success"></i>

                               <div class="text-right">

                                   <h5>Copies sold</h5>

                                   <span id="copies_sold"></span>

                               </div>

                           </div>

                       </div>

                       <div class="card-footer">

                           <i class="fas fa-sync mb-3"></i> Refresh

                       </div>

                   </div>

               </div>

            </div>

        </div>

    </section>

    <section id="charts">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <div class="row">

                        <div class="col-md-12">

                            <h4 class="page-title">Copies sold by category</h4>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <canvas id="copies_by_month"></canvas>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="row">

                        <div class="col-md-12">

                            <h4 class="page-title">Sales by month</h4>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <canvas id="sales_by_month"></canvas>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="row">

                        <div class="col-md-12">

                            <h4 class="page-title">Copies sold by month</h4>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <canvas id="copies_by_month"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php
    require_once VIEWS_DIR . 'admin_footer.php';

