<?php 

require_once 'config.php';

$host = HOST;
$userDB = DATABASE_USERNAME;
$pswDB = DATABASE_PASSWORD;
$nomeDB = DATABASE_NAME;

$conn = new mysqli($host, $userDB, $pswDB);

if ( $conn -> connect_error ) {
    die('Non è possibile effettuare la connessione' . $conn->connect_error );
}

$sql = "CREATE DATABASE IF NOT EXISTS $nomeDB";

$stmt = $conn->prepare($sql);

if ( $stmt -> execute() === FALSE ) {
    die('Non è stato possibile creare il database ' . $stmt -> error );
};

$conn = new mysqli($host, $userDB, $pswDB, $nomeDB);