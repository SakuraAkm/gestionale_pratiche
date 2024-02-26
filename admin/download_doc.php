<?php 
include_once '../inc/functions.php';

if($_SESSION['login'] == false)
{
    header('location: ../index.php');
    exit;
}

$path = $_GET["path"];
$id = $_GET["id"];

download_doc("../$path");

if ($id === "0") {
    header("Location: ../visualizza_admin.php");
    exit;
} else {
    header("Location: visualizza.php?idpratica=$id");
    exit;
}
?>