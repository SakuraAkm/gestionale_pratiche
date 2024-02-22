
<?php

include_once 'inc/db.config.php';

$nomeCartella = "uploads_doc/";

$cartellaUpload = APP_DIR . '/' . $nomeCartella ;

 
if ( !is_dir( $cartellaUpload ) ) {
    mkdir( $cartellaUpload, 0755 );
}

$fileDestinazione = $cartellaUpload . basename( $_FILES['documenti']['name'] );

var_dump($fileDestinazione);

if ( !file_exists( $fileDestinazione ) ) {

    move_uploaded_file($_FILES['documenti']['tmp_name'], $fileDestinazione);

}



$partedatrovare = APP_DIR;

$fileDestinazioneDatabase = str_replace( $partedatrovare, '', $fileDestinazione);



