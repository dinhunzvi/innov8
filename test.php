<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once './core/initialize.php';

$mailer = new PHPMailer();

$email_settings = Config::get_instance()->get( 'email_settings' );

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
$mailer->Host = $email_settings['server'];
$mailer->Port = $email_settings['smtp_port'];
$mailer->Username = $email_settings['username'];
$mailer->Password = $email_settings['password'];
$mailer->isHTML( true );
$mailer->FromName = $email_settings['sender'];
$mailer->From = $email_settings['username'];

$mailer->addAddress( 'dougiedj@gmail.com', 'Douglas Nhunzvi' );
$mailer->Subject = 'Test message';
$mailer->Body = 'This is a test message.';

return $mailer->send();