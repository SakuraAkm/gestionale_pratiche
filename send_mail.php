<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {

    // IMPOSTAZIONI SERVER SMTP
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->isSMTP();
    $mail->Host = 'smtp.sendgrid.net'; // Host SMTP di SendGrid
    $mail->SMTPAuth = true;
    $mail->Username = 'apikey'; 
    $mail->Password = 'pass_key';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    // MITTENTE

    $mail->setFrom( 'gestionale_pratiche@virgilio.it' );

    // DESTINATARI

    $mail->addAddress('esempio@gmail.com', '');
    // $mail->AddCC('utenti-in-copia@esempio.com');
    //$mail->addReplyTo($username);

    //$mail->isHTML(true);
    $mail->Subject = "Nuovo utente registrato";
    $mail->Body = "L'utente con l'username si è appena registrato";

    $mail->send();

    echo "Utente Registrato";

} catch(Exception $e) {

    echo "Utente non registrato. Errore:" . $mail->ErrorInfo;

}