<?php

include_once '../inc/db.config.php';

$id = $_POST['id'];
$corso = $_POST['aggiorna-corso'];
$nome_utente = $_POST['aggiorna-nome-utente'];
$nome_responsabile = $_POST['aggiorna-nome-responsabile'];
$documenti = $_POST['aggiorna-documenti'];
// stato da da rendere variabile
$stato = 1;

$sql = "UPDATE pratiche SET 
    corso=?, nome_utente=?, nome_responsabile=?, documenti=?, stato=? WHERE id=?";

$stmt = $conn -> prepare( $sql );
$stmt -> bind_param('ssssii', $corso, $nome_utente, $nome_responsabile, $documenti, $stato, $id);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

header('Location: ../visualizza_admin.php');
exit;