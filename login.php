<?php 
include_once 'inc/db.config.php';
include_once 'inc/functions.php';

$email_responsabile = $_POST['username-login'];
$password = $_POST['password-login'];

$info_utente = array(
    "conn" => $conn,
    "email"=> $email_responsabile,
    "password"=> $password
);

crea_utente($info_utente);

$sql = "SELECT * FROM utenti WHERE email = ? ";

$stmt = $conn -> prepare($sql);
$stmt -> bind_param('s', $email_responsabile);

if($stmt->execute() === false){
    die("Errore" . $stmt->error);
}

$results = $stmt->get_result();

if($results->num_rows > 0){
    $row = $results->fetch_assoc();
    $password = $password . AUTH_SALT;

    if ( password_verify($password, $row['psw']) ) {
        $_SESSION['login'] = $row['privilegi'];
        $_SESSION['email'] = $row['email'];
        unset($row['psw']);
        unset($password);
        $stmt->close();
        $conn->close();
        header('Location: visualizza_admin.php');
        exit;
    } else {
        $_SESSION['error'] = "Credenziali non valide.";
        $stmt->close();
        $conn->close();
        header('location: login_admin.php');
        exit;
    }
}
else{
    $_SESSION['error'] = "Credenziali non valide.";
    $stmt->close();
    $conn->close();
    header('location: login_admin.php');
    exit;
}