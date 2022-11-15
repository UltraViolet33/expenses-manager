<?php require_once '../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}


$expense->delete($_GET["id"]);


    header("Location: index.php");