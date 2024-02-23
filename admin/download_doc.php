<?php 
include_once '../inc/functions.php';

$path = $_GET["path"];
$id = $_GET["id"];

download_doc("../$path");

if ($id === "0") {
    header("Location: ../visualizza_admin.php");
    exit;
} else {
    header("Location: visualizza.php?idpratiche=$id");
    exit;
}
?>