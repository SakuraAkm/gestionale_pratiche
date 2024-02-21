<?php

include_once 'inc/db.config.php';

$id = $_POST['id_pratica'];
$username = $_POST['emailUtente'];
$corso = $_POST['corso'];
$documenti = $_POST['documenti'];
$stato = 1;

$sql = "UPDATE pratiche SET corso=?, documenti=?, username=? WHERE id=?";

$stmt = $conn -> prepare( $sql );
$stmt -> bind_param('sssi', $corso, $documenti, $username, $stato);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

header('Location: visualizza_admin.php');
exit;