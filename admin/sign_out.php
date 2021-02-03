<?php
    require_once './../core/initialize.php';

    $user = new User;

    $user->sign_out();

    redirect( 'sign_in.php' );