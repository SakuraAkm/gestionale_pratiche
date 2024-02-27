<?php
include_once 'inc/db.config.php';
session_start();

$email = $_POST['email-register'];
$password = $_POST['password-register'];

$sql = 'SELECT email FROM utenti WHERE email=?';

$stmt = $conn -> prepare($sql);

$stmt -> bind_param('s', $email);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile eseguiere la query');
};

$risultato = $stmt -> get_result();

if ( $risultato -> num_rows > 0 ) {
    $_SESSION['error'] = "Utente già registrato.";
    $stmt->close();
    $conn->close();
    header('location: login_admin.php');
    exit;
} 

$password = $password . AUTH_SALT;
$password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO utenti ( email, psw ) VALUES ( ?, ?) ";

$stmt = $conn -> prepare($sql);

$stmt -> bind_param('ss', $email, $password);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile eseguire la query');
}
$stmt->close();
$conn->close();
header('location: login_admin.php');
$_SESSION['mex']='registrazione avvenuta con successo, effettua il login';
exit;
?>