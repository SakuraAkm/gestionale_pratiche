<?php 
include_once 'inc/db.config.php';

$username = $_POST['username-login'];
$password = $_POST['password-login'];

$sql = "SELECT * FROM utenti WHERE username = '$username' ";

$stmt = $conn -> prepare($sql);

if($stmt->execute() === false){
    die("Errore" . $stmt->error);
}

$results = $stmt->get_result();

if($results->num_rows > 0){
    $row = $results->fetch_assoc();

    // controllare la password

} else{
    echo "Dati inseriti non corretti";
}


$stmt->close();
$conn->close();
