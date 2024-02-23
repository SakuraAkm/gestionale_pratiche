<?php
include_once "upload_doc.php";
include_once 'inc/db.config.php';

$nome_utente = $_POST['emailUtente'];
$corso = $_POST['corso'];
$documenti = $fileDestinazioneDatabase;
$stato_pratica = 1;


$sql = 'CREATE TABLE IF NOT EXISTS pratiche (
    id_pratica INT(4) AUTO_INCREMENT PRIMARY KEY,
    corso VARCHAR(255) NOT NULL,
    documenti TEXT NOT NULL,
    nome_utente VARCHAR(255) NOT NULL,
    nome_responsabile VARCHAR(255),
    stato_pratica INT(4) NOT NULL,
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)';
$stmt = $conn->prepare($sql);
    
if ( $stmt -> execute() === FALSE ) {
    die('Non è stato possibile creare la tabella pratiche ' . $stmt -> error );
};

$sql = "INSERT INTO pratiche ( corso, documenti, nome_utente, stato_pratica ) VALUES ( ?, ?, ?, ?)";

$stmt = $conn -> prepare( $sql );
$stmt -> bind_param('sssi', $corso, $documenti, $nome_utente, $stato_pratica);

if ( $stmt -> execute() === FALSE ) {
    die('DATI NON INSERITI ' . $stmt -> error );
};

$stmt->close();
$conn->close();

header('Location: visualizza_pratiche.php');
exit;

?>