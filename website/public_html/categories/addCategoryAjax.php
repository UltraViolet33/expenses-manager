<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-requested-With');

// require_once __DIR__ . '/../core/classes/Category.php';

// $category = new Category();

require_once __DIR__ . '/../../core/controllers/CategoryController.php';
$categoryController = new CategoryController();

// $data = json_decode(file_get_contents("php://input"));
// $data = (array) $data;

// $result = $categoryController->add($data);

// $allCategories = $categoryController->getAll();

// if ($result) {
//     $message = ["message" => "category added successfully", "allCategories" => $allCategories];
//     echo json_encode($message);
//     http_response_code(200);
//     die;
// }


echo "heeelo";