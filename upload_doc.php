<?php

include_once 'inc/db.config.php';
include_once 'inc/functions.php';

$nomeCartella = "uploads_doc/";

$cartellaUpload = APP_DIR . '/' . $nomeCartella ;
 
if ( !is_dir( $cartellaUpload ) ) {
    mkdir( $cartellaUpload, 0755 );
}

$fileDestinazione = $cartellaUpload . basename( $_FILES['documenti']['name'] );

$partedatrovare = APP_DIR;

$fileDestinazioneDatabase = str_replace( $partedatrovare, '', $fileDestinazione);

$fileDestinazioneDatabase = substr($fileDestinazioneDatabase, 1);

//variabili estensioni permesse e dati file caricato
$estensioni_permesse = array('pdf' => 'application/pdf', 'doc' => 'application/msword', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpg', 'txt' => 'text/plain');
$nome_file = $_FILES["documenti"]["name"];
$tipo_file = $_FILES["documenti"]["type"];
$dimensione_file = $_FILES["documenti"]["size"];

//prende l'esensione del file
$estensione = pathinfo($nome_file, PATHINFO_EXTENSION);

//controlla che il formato sia valido
if(!array_key_exists($estensione, $estensioni_permesse)){
    $_SESSION['error'] = "Errore: formato file non valido";
    $conn->close();
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        header('location: form_aggiorna_pratica.php?idpratica=' . "$id");
        exit;
    }
    else
    {
        $_SESSION['email_utente'] = $_POST['emailUtente'];
        $_SESSION['corso'] = $_POST['corso'];
        header('location: form_pratica.php');
        exit;
    }
}

//controlla la dimensione massima 5Mb sia rispettata
$dimensione_massima = 5 * 1024 * 1024;
if($dimensione_file > $dimensione_massima) {
    $_SESSION['error'] = "Errore: dimensione file superata";
    $conn->close();
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        header('location: form_aggiorna_pratica.php?idpratica=' . "$id");
        exit;
    }
    else
    {
        $_SESSION['email_utente'] = $_POST['emailUtente'];
        $_SESSION['corso'] = $_POST['corso'];
        header('location: form_pratica.php');
        exit;
    }
}

//controlla se il tipo del file è presente tra i tipi permessi (ex: un txt sarà text/plain)
if(in_array($tipo_file, $estensioni_permesse)){
    if ( !file_exists( $fileDestinazione ) ) {
        move_uploaded_file($_FILES['documenti']['tmp_name'], $fileDestinazione);
    } else{
        $_SESSION['error'] = "Errore: file non valido";
        $conn->close();
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            header('location: form_aggiorna_pratica.php?idpratica=' . "$id");
            exit;
        }
        else
        {
            $_SESSION['email_utente'] = $_POST['emailUtente'];
            $_SESSION['corso'] = $_POST['corso'];
            header('location: form_pratica.php');
            exit;
        }
    }
} else{
    $_SESSION['error'] = "Errore: formato file non valido";
    $conn->close();
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        header('location: form_aggiorna_pratica.php?idpratica=' . "$id");
        exit;
    }
    else
    {
        $_SESSION['email_utente'] = $_POST['emailUtente'];
        $_SESSION['corso'] = $_POST['corso'];
        header('location: form_pratica.php');
        exit;
    }
}