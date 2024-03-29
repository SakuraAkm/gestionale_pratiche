<?php

require_once 'config.php';

session_start();

function get_header( $title = "Titolo Generico" ) {

    include_once APP_DIR . '/template/header.php';

}


function get_footer( $credits = "Crediti Generici" ) {

    include_once APP_DIR . '/template/footer.php';

}

function crea_pratiche($conn){
    $sql = 'CREATE TABLE IF NOT EXISTS pratiche (
        id_pratica INT(4) AUTO_INCREMENT PRIMARY KEY,
        corso VARCHAR(255) NOT NULL,
        documenti TEXT NOT NULL,
        email_utente VARCHAR(255) NOT NULL,
        nome_responsabile VARCHAR(255),
        stato_pratica INT(4) NOT NULL,
        data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )';
    $stmt = $conn->prepare($sql);
        
    if ( $stmt -> execute() === FALSE ) {
        die('Non è stato possibile creare la tabella pratiche ' . $stmt -> error );
    }
}

function crea_utenti($conn)
{
    $sql = 'CREATE TABLE IF NOT EXISTS utenti (
        id_utente INT(4) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        psw TEXT NOT NULL,
        privilegi INT(2) NOT NULL,
        data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )';
    
    $stmt = $conn->prepare($sql);
    
    if ( $stmt -> execute() === FALSE ) {
        die('Non è stato possibile creare la tabella utenti ' . $stmt -> error );
    }
}

function download_doc($percorso)
{
    $file = $percorso;//'assets/images/6.png'

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

function crea_utente($array)
{
    $email = $array["email"];
    $password = $array["password"] . AUTH_SALT;
    $password = password_hash($password, PASSWORD_BCRYPT);
    $privilegi = 1;

    $sql = 'SELECT email FROM utenti';

    $stmt = $array["conn"] -> prepare($sql);

    if ( $stmt -> execute() === FALSE ) {
        die('non è possibile eseguiere la query');
    }

    $risultato = $stmt -> get_result();

    if ( $risultato -> num_rows == 0 ) {

        $sql = "INSERT INTO utenti ( email, psw, privilegi) VALUES (?, ?, ?) ";

        $stmt = $array["conn"] -> prepare($sql);

        $stmt -> bind_param('ssi',$email, $password, $privilegi);

        if ( $stmt -> execute() === FALSE ) {
            die('non è possibile eseguire la query');
        } 
    }
}

function elimina_file($path)
{
    $nomeFile = $path; // Percorso del file

    print_r($nomeFile);
    // Verifica se il file esiste prima di tentare di cancellarlo
    if (file_exists($nomeFile)) {
        // Tentativo di cancellare il file
        if (unlink($nomeFile)) {
            echo "Il file è stato cancellato con successo.";
        } else {
            echo "Si è verificato un errore durante la cancellazione del file.";
        }
    } else {
        echo "Il file non esiste.";
    }
}

function logout()
{
    $_SESSION['login'] = 0;
    unset($_SESSION['error']);
    unset($_SESSION['mex']);
    unset($_SESSION['email_utente']);
    unset($_SESSION['corso']);
    unset($_SESSION['email']);
}