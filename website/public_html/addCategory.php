<?php
header('Access-Control-Allow-Origin: http://localhost:8000');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-requested-With');

require_once __DIR__ . '/../core/classes/Category.php';

$category = new Category();

$data = json_decode(file_get_contents("php://input"));
$data = (array) $data;

$result = $category->addCategory($data);

$allCategories = $category->getAll();

if ($result) {
    $message = ["message" => "category added successfully", "allCategories" => $allCategories];
    echo json_encode($message);
    http_response_code(200);
    die;
}
