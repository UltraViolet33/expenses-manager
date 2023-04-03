<?php require_once '../../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$expenseController->delete($_GET["id"]);

header("Location: allExpenses.php");
