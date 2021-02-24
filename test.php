<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once './core/initialize.php';

$mailer = new PHPMailer();

$mailer->isSMTP();
$mailer->Mailer = 'smtp';
$mailer->SMTPAuth = true;
$mailer->SMTPDebug = 2;
$mailer->SMTPSecure = 'tls';
/*$mailer->SMTPOptions = array(
    'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => false

    )
);*/
$mailer->Host = 'smtp.gmail.com';
$mailer->Port = 587;
$mailer->Username = 'luisaommatumona1@gmail.com';
$mailer->Password = 'ilovehandball1997';
$mailer->isHTML( true );
$mailer->FromName = 'Luisa P M Matumona';
$mailer->From = 'luisaommatumona1@gmail.com';

$mailer->addAddress( 'dougiedj@gmail.com', 'Douglas Nhunzvi' );
$mailer->Subject = 'Test message';
$mailer->Body = 'This is a test message.';

return $mailer->send();