<?php

include_once '../inc/db.config.php';
include_once '../upload_doc.php';
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
$stato_pratica = $_POST['aggiorna-stato'];

if(!empty($_FILES['documenti']['name']))
{
    $documenti = $fileDestinazioneDatabase;
    $sql = "UPDATE pratiche SET corso=?, nome_utente=?, nome_responsabile=?, documenti=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('ssssii', $corso, $nome_utente, $nome_responsabile, $documenti, $stato_pratica, $id);
}
else 
{
    $sql = "UPDATE pratiche SET corso=?, nome_utente=?, nome_responsabile=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('sssii', $corso, $nome_utente, $nome_responsabile, $stato_pratica, $id);
}

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

header('Location: ../visualizza_admin.php');
exit;