<?php
    require_once './core/initialize.php';

    $customer = new Customer();

    $customer->sign_out();

    redirect( 'index.php' );