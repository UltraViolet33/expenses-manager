<?php require_once '../../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$data = [
    "id_income" => $_GET['id']
];


$incomeController->validateIncome($data);

header("Location: ../index.php");
