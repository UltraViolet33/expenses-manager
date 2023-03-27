<?php require_once '../../inc/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$categoryController->delete($_GET["id"]);

header("Location: /categories/allCategories.php");