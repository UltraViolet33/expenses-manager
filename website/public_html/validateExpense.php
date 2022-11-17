<?php require_once '../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}

// $expense->delete($_GET["id"]);
$data = [
    "id_expense" => $_GET['id']
];

$expense->validate($data);

$recurentExpense = $expense->getSingleExpense($_GET['id']);

// var_dump($recurentExpense);

$data = [
    "name" => $recurentExpense->expense_name, "amount" => $recurentExpense->amount,
    "created_at" => Date('Y-m-d'), "id_category" => $recurentExpense->id_category, 
    "id_recurence" => null, "status" => null 
];

$expense->create($data);

header("Location: index.php");