<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_email($dati)
{
    $mail = new PHPMailer(true);

    try {

        // IMPOSTAZIONI SERVER SMTP
        $mail->isSMTP();
        $mail->Host = 'out.virgilio.it'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'gestionale_pratiche@virgilio.it'; 
        $mail->Password = 'Email.Website2017'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        // MITTENTE

        $mail->setFrom( EMAIL_FROM );

        // DESTINATARI

        $mail->addAddress($dati['email_responsabile'], $dati['nome_responsabile']);
        $mail->addAddress($dati['email_utente'], '');

        // Contenuto email
        $mail->Subject = $dati['subject'];
        $mail->Body = $dati['body'];

        if($mail->send())
            $_SESSION['mex'] = "Email inviata con successo";

    } catch(Exception $e) {
        
        $_SESSION['error'] = "Email non inviata.";

    }
}

function send_email_p()
{
    $mail = new PHPMailer(true);

    try {

        // IMPOSTAZIONI SERVER SMTP
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->isSMTP();
        $mail->Host = 'smtp.sendgrid.net'; // Host SMTP di SendGrid
        $mail->SMTPAuth = true;
        $mail->Username = 'apikey'; 
        $mail->Password = 'key'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // MITTENTE

        $mail->setFrom( EMAIL_FROM ); //chi la manda

        // DESTINATARI

        $mail->addAddress('prova@prova.com', '');//a chi deve arrivare
        //$mail->AddCC('utenti-in-copia@esempio.com');
        //$mail->addReplyTo($username);

        //$mail->isHTML(true);
        $mail->Subject = 'ali di farfalla';
        $mail->Body = 'Le farfalle sbattono le ali e fanno i tornadi';

        if($mail->send())
            $_SESSION['mex'] = "Email inviata con successo";

    } catch(Exception $e) {

        $_SESSION['error'] = "Email non inviata. Errore:" . $mail->ErrorInfo;

    }
}