<?php 
include_once 'inc/db.config.php';

$nome_utente = $_POST['username-login'];
$password = $_POST['password-login'];

$sql = "SELECT * FROM utenti WHERE username = ? ";

$stmt = $conn -> prepare($sql);
$stmt -> bind_param('s', $nome_utente);

if($stmt->execute() === false){
    die("Errore" . $stmt->error);
}

$results = $stmt->get_result();

if($results->num_rows > 0){
    $row = $results->fetch_assoc();

    $row = $risultato -> fetch_assoc();

    $password_DB = $row['psw'];

    $password = $password . AUTH_SALT;

    if ( password_verify($password, $password_DB) ) {

      echo "ok";

    } else {

      echo "Password non valida";

    }

} else{
    echo "Dati inseriti non corretti";
}


$stmt->close();
$conn->close();
