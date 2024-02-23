<?php

require_once 'config.php';

function get_header( $title = "Titolo Generico" ) {

    include_once APP_DIR . '/template/header.php';

}


function get_footer( $credits = "Crediti Generici" ) {

    include_once APP_DIR . '/template/footer.php';

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

function create_utenti($conn){

    $sql = 'CREATE TABLE IF NOT EXISTS utenti (
        id_utente INT(4) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        psw TEXT NOT NULL,
        privilegi INT(2) NOT NULL,
        data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )';
    
    $stmt = $conn->prepare($sql);
    
    if ( $stmt -> execute() === FALSE ) {
        die('Non è stato possibile creare la tabella utenti ' . $stmt -> error );
    };

    $username = 'admin@admin.it';
    $password = 'admin' . AUTH_SALT;
    $password = password_hash($password, PASSWORD_BCRYPT);
    $privilegi = 1;

    $sql = 'SELECT username FROM utenti WHERE username=?';

    $stmt = $conn -> prepare($sql);

    $stmt -> bind_param('s', $username);

    if ( $stmt -> execute() === FALSE ) {
        die('non è possibile eseguiere la query');
    };

    $risultato = $stmt -> get_result();

    if ( $risultato -> num_rows == 0 ) {

        $sql = "INSERT INTO utenti ( username, psw, privilegi) VALUES ( ?, ?, ?) ";

        $stmt = $conn -> prepare($sql);

        $stmt -> bind_param('ssi', $username, $password, $privilegi);

        if ( $stmt -> execute() === FALSE ) {
            die('non è possibile eseguire la query');
        } 
    }
}