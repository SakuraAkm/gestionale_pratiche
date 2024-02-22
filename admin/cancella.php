<?php

include_once '../inc/db.config.php';

$id = $_GET['idpratiche'];

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