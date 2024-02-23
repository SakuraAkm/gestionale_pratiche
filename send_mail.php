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
    $mail->Password = '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';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    // MITTENTE

    $mail->setFrom( 'gestionale_pratiche@virgilio.it' );

    // DESTINATARI

    $mail->addAddress('leotne98@gmail.com', 'Leo');
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