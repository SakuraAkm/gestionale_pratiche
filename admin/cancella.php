<?php

include_once '../inc/db.config.php';
include_once '../inc/functions.php';

if($_SESSION['login'] == false)
{
    header('location: ../index.php');
    exit;
}

$id = $_GET['idpratica'];

$sql = "SELECT documenti FROM pratiche WHERE id_pratica=?";

$stmt = $conn -> prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt -> execute() === FALSE ) {
    die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error);
};

$risultati = $stmt -> get_result();
$riga = $risultati -> fetch_assoc();

elimina_file('../' . $riga['documenti']);

$sql = "DELETE FROM pratiche WHERE id_pratica=?";

$stmt = $conn -> prepare( $sql );

$stmt -> bind_param('i', $id);

if ( $stmt -> execute() === FALSE ) {
    die('non è possibile cancellare il dato');
};

$stmt -> close();
$conn -> close();

header('Location: ../visualizza_admin.php');
exit();
?>