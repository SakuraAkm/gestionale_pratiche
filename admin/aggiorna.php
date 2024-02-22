<?php

include_once '../inc/db.config.php';

session_start();
if($_SESSION['login'] == false)
{
    header('location: index.php');
    exit;
}

$id = $_POST['id'];
$corso = $_POST['aggiorna-corso'];
$nome_utente = $_POST['aggiorna-nome-utente'];
$nome_responsabile = $_POST['aggiorna-nome-responsabile'];
$documenti = $_POST['aggiorna-documenti'];
$stato_pratica = $_POST['aggiorna-stato'];

$sql = "UPDATE pratiche SET corso=?, nome_utente=?, nome_responsabile=?, documenti=?, stato_pratica=?  WHERE id_pratica=?";

$stmt = $conn -> prepare( $sql );
if ($stmt === FALSE) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt -> bind_param('ssssii', $corso, $nome_utente, $nome_responsabile, $documenti, $stato_pratica, $id);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

header('Location: ../visualizza_admin.php');
exit;