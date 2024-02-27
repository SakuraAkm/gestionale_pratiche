<?php

include_once '../inc/db.config.php';
include_once '../inc/functions.php';

if($_SESSION['login'] == false)
{
    header('location: ../index.php');
    exit;
}

$email_responsabile = $_POST['email-profilo'];
$password_responsabile = $_POST['password-profilo'];

$password = $password_responsabile . AUTH_SALT;
$password = password_hash($password, PASSWORD_BCRYPT);

  
$sql = "UPDATE utenti SET email=?, psw=? WHERE id_utente=1";

$stmt = $conn -> prepare( $sql );
if ($stmt === FALSE) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt -> bind_param('ss', $email_responsabile, $password);


if ( $stmt -> execute() === FALSE ) {
    die('non è possibile aggiornare i dati' . $stmt->error);
};

$stmt->close();
$conn->close();

header('Location: ../visualizza_admin.php');
exit;
?>