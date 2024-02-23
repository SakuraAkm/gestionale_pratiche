<?php
/*
include_once 'inc/db.config.php';

$nomeCartella = "uploads_doc/";

$cartellaUpload = APP_DIR . '/' . $nomeCartella ;
 
if ( !is_dir( $cartellaUpload ) ) {
    mkdir( $cartellaUpload, 0755 );
}

$fileDestinazione = $cartellaUpload . basename( $_FILES['documenti']['name'] );

//var_dump($fileDestinazione);

if ( !file_exists( $fileDestinazione ) ) {

    move_uploaded_file($_FILES['documenti']['tmp_name'], $fileDestinazione);

}

$partedatrovare = APP_DIR;

$fileDestinazioneDatabase = str_replace( $partedatrovare, '', $fileDestinazione);
*/
?>

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





$estensioni_permesse = array('pdf' => 'application/pdf', 'doc' => 'application/msword', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpg');
$nome_file = $_FILES["documenti"]["name"];
$tipo_file = $_FILES["documenti"]["type"];
$dimensione_file = $_FILES["documenti"]["size"];

$estensione = pathinfo($nome_file, PATHINFO_EXTENSION);

if(!array_key_exists($estensione, $estensioni_permesse)){
$_SESSION['error'] = "Errore: formato non valido";
$conn->close();
header('location: form_pratica.php');
exit;
}

$dimensione_massima = 5 * 1024 * 1024;
if($dimensione_file > $dimensione_massima) {
    $_SESSION['error'] = "Errore: dimensione massima superata";
    $conn->close();
    header('location: form_pratica.php');
    exit;
}


if(in_array($tipo_file, $estensioni_permesse)){
    if ( !file_exists( $fileDestinazione ) ) {

        move_uploaded_file($_FILES['documenti']['tmp_name'], $fileDestinazione);
        echo "Il tuo file è stato caricato con successo!";
    } else{
        $_SESSION['error'] = $nome_file . "esiste già.";
        header('location: form_pratica.php');
        exit;
    }
} else{
    $_SESSION['error'] = "Errore: problema nel caricamento del file, riprova.";
    header('location: form_pratica.php');
    exit;
}




//var_dump($fileDestinazione);

// if ( !file_exists( $fileDestinazione ) ) {

//     move_uploaded_file($_FILES['documenti']['tmp_name'], $fileDestinazione);

// }



