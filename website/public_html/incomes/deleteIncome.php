<?php require_once '../../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: /incomes/allIncomes.php");
}

$incomeController->delete($_GET["id"]);

header("Location: /incomes/allIncomes.php");
