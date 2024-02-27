<?php
include_once "upload_doc.php";
include_once 'inc/db.config.php';

$email_utente = $_POST['emailUtente'];
$corso = $_POST['corso'];
$documenti = $fileDestinazioneDatabase;
$stato_pratica = 1;

$sql = "INSERT INTO pratiche ( corso, documenti, nome_utente, stato_pratica ) VALUES ( ?, ?, ?, ?)";

$stmt = $conn -> prepare( $sql );
$stmt -> bind_param('sssi', $corso, $documenti, $email_utente, $stato_pratica);

if ( $stmt -> execute() === FALSE ) {
    die('DATI NON INSERITI ' . $stmt -> error );
};

$stmt->close();
$conn->close();

header('Location: visualizza_pratiche.php');
exit;

?>