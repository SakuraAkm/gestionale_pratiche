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