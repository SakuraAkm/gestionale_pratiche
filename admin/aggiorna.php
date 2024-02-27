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
$nome_responsabile = $_POST['aggiorna-corso'];
$email_responsabile = $_POST['aggiorna-nome-utente'];
$password_responsabile = $_POST['aggiorna-nome-responsabile'];
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
    $sql = "UPDATE pratiche SET corso=?, nome_utente=?, nome_responsabile=?, documenti=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('ssssii', $nome_responsabile, $email_responsabile, $password_responsabile, $documenti, $stato_pratica, $id);
}
else 
{    
    $sql = "UPDATE pratiche SET corso=?, nome_utente=?, nome_responsabile=?, stato_pratica=?  WHERE id_pratica=?";

    $stmt = $conn -> prepare( $sql );
    if ($stmt === FALSE) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt -> bind_param('sssii', $nome_responsabile, $email_responsabile, $password_responsabile, $stato_pratica, $id);
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
    $pratica = 'In corso';
}
else if($stato_pratica == 3)
{
    $pratica = 'Completata';
}
$body = "La pratica n: $id è stata assegnata al responsabile $password_responsabile, stato pratica: $pratica"; 
$dati = array (
    "email_from" => EMAIL_FROM,
    "email_from_name" => $password_responsabile,
    "email_to" => $email_responsabile,
    "subject" => "Gestionale pratiche - Aggiornamento pratica n: $id",
    "body" => $body
); 

send_email($dati);

header('Location: ../visualizza_admin.php');
exit;