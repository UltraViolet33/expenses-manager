<?php require_once '../../inc/header.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$data = [
    "id_income" => $_GET['id']
];


$incomeController->validateIncome($data);

// $incomeModel->validate($data);

//  $recurentIncome = $incomeModel->getSingleIncome($_GET['id']);

//  var_dump($recurentIncome);



// $data = [
//     "name" => $recurentIncome->income_name, "amount" => $recurentIncome->amount,
//     "created_at" => Date('Y-m-d'),  
//     "id_recurence" => null, "status" => null 
// ];

// $incomeModel->create($data);
// header("Location: index.php");


header("Location: ../index.php");
