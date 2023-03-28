<?php
require_once __DIR__ . '/../core/connection/Session.php';
Session::init();
// require_once __DIR__ . '/../core/classes/Category.php';
// require_once __DIR__ . '/../core/classes/Recurence.php';
require_once __DIR__ . '/../core/classes/Expense.php';
require_once __DIR__ . '/../core/classes/Income.php';
require_once __DIR__ . '/../core/helpers/Format.php';
require_once __DIR__ . '/../core/helpers/Helper.php';

define('ROOT', "/public_html");

// $category = new Category();
// $recurenceModel = new Recurence();
$expense = new Expense();
$incomeModel = new Income();
$format = new Format();
$helperClass = new Helper();



require_once __DIR__ . '/../core/controllers/CategoryController.php';
$categoryController = new CategoryController();

require_once __DIR__ . '/../core/controllers/RecurenceController.php';
$recurenceController = new RecurenceController();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title><?= isset($titlePage) ? $titlePage : "Expenses Manager" ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid ">
            <a href="/" class="navbar-brand text-white">Expenses Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expenses
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/allExpenses.php">All expenses</a></li>
                            <li><a class="dropdown-item" href="/expenses/addExpense.php">Add an expense</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Incomes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./allIncomes.php">All incomes</a></li>
                            <li><a class="dropdown-item" href="./addIncome.php">Add an income</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/categories/allCategories.php">All categories</a></li>
                            <li><a class="dropdown-item" href="/categories/addCategory.php">Add a category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./data.php">Historique</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>