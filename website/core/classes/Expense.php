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


    public function create($name, $amount, $date, $category, $period, $recurrence)
    {
        if (empty($name) || empty($amount) || empty($category)) {
            return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
        }

        $sql = "INSERT INTO expenses (name, amount, created_at, id_category, period, recurrence, id_user) VALUES (:name, :amount, :created_at, :id_category, :period, :recurrence, :id_user)";

        $data = [
            "name" => $name,
            "amount" => $amount, "created_at" => $date, "id_category" => $category,"period" => $period, "recurrence" => $recurrence, "id_user" => Session::get('userId')
        ];

        return $this->db->write($sql, $data);
    }


    public function selectExpensesGroupByMonthAndCategory()
    {
        $sql = "SELECT DATE_FORMAT(ex.created_at, '%M') AS month, 
        ex.id_category, cat.name AS category_name,  SUM(ex.amount) AS total_expenses FROM expenses AS ex 
        INNER JOIN categories AS cat ON cat.id_category = ex.id_category WHERE ex.recurrence = 0
        GROUP BY DATE_FORMAT(ex.created_at, '%M'), ex.id_category";

        return $this->db->read($sql);
    }
}
