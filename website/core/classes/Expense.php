<?php
require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";


class Expense
{

    private $helper;
    private $db;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->db = new Database();
    }


    public function select()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, categories.name AS category_name FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        WHERE ex.id_user = :id_user ORDER BY ex.created_at DESC LIMIT 10 ";

        $data['id_user'] = Session::get('userId');
        return $this->db->read($sql, $data);
    }


    public function create($name, $amount, $category)
    {
        if (empty($name) || empty($amount) || empty($category)) {
            return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
        }

        $sql = "INSERT INTO expenses (name, amount, created_at, id_category, id_user) VALUES (:name, :amount, :created_at, :id_category, :id_user)";

        $data = [
            "name" => $name,
            "amount" => $amount, "created_at" => Date("Y-m-d"), "id_category" => $category, "id_user" => Session::get('userId')
        ];

        return $this->db->write($sql, $data);
    }
}
