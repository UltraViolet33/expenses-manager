<?php require_once '../../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$data = [
    "id_expense" => $_GET['id']
];

$expenseController->validateExpense($data);

header("Location: ../index.php");
