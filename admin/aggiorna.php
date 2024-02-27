<?php

include_once '../inc/db.config.php';
include_once '../send_mail.php';
include_once '../inc/functions.php';

if($_SESSION['login'] == false)
{
    header('location: ../index.php');
    exit;
}

$id = $_POST['id'];
$corso = $_POST['aggiorna-corso'];
$email_utente = $_POST['aggiorna-nome-utente'];
$nome_responsabile = $_POST['aggiorna-nome-responsabile'];
$stato_pratica = $_POST['aggiorna-stato'];

if(!empty($_FILES['documenti']['name']))
{
    include_once '../upload_doc.php';
    $sql = "SELECT documenti FROM pratiche WHERE id_pratica=?";

    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt -> execute() === FALSE ) {
        die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error);
    };

    $risultati = $stmt -> get_result();
    $riga = $risultati -> fetch_assoc();

    elimina_file('../' . $riga['documenti']);
    $documenti = $fileDestinazioneDatabase;
    $sql = "UPDATE pratiche SET corso=?, documenti=?, email_utente=?, nome_responsabile=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('ssssii', $corso, $documenti, $email_utente, $nome_responsabile, $stato_pratica, $id);
    $doc = true;
}
else 
{    
    $sql = "UPDATE pratiche SET corso=?, email_utente=?, nome_responsabile=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('sssii', $corso, $email_utente, $nome_responsabile, $stato_pratica, $id);
    $doc = false;
}

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

if($stato_pratica == 1)
{
    $pratica = 'Presa in carica';
}
else if($stato_pratica == 2)
{
    $pratica = 'In Lavorazione';
}
else if($stato_pratica == 3)
{
    $pratica = 'Completata';
}
if($doc)
    $body = "La documentazione della pratica n: $id è stata aggiornata.\n Pratica assegnata al responsabile $nome_responsabile.\n Corso: $corso.\n Stato pratica: $pratica."; 
else
    $body = "La pratica n: $id è stata aggiornata.\n Pratica assegnata al responsabile: $nome_responsabile.\n Corso: $corso.\n Stato pratica: $pratica."; 
$dati = array (
    "email_responsabile" => $_SESSION['email'],
    "nome_responsabile" => $nome_responsabile,
    "email_utente" => $email_utente,
    "subject" => "Gestionale pratiche - Aggiornamento pratica n: $id",
    "body" => $body
); 

send_email($dati);

header('Location: ../visualizza_admin.php');
exit;