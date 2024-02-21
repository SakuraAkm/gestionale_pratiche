<?php

include_once 'inc/db.config.php';

$username = $_POST['emailUtente'];
$corso = $_POST['corso'];
$documenti = "doc";//$_POST['documenti'];
$stato = 1;
$sql = "INSERT INTO pratiche ( corso, documenti, nome_utente, stato_pratica ) VALUES ( ?, ?, ?, ?)";

$stmt = $conn -> prepare( $sql );
$stmt -> bind_param('sssi', $corso, $documenti, $username, $stato);

if ( $stmt -> execute() === FALSE ) {
    die('DATI NON INSERITI ' . $stmt -> error );
};

$stmt->close();
$conn->close();

header('Location: visualizza_pratiche.php');
exit;

?>