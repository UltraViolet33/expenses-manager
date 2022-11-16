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


    public function getSingleExpense($id)
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.id_recurence, ex.created_at, categories.name AS category_name FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category WHERE id_expense = :id_expense";

        return $this->db->readOneRow($sql, ["id_expense" => $id]);
    }


    public function select()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, categories.name AS category_name FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        WHERE ex.id_user = :id_user AND ex.recurrence = 0 ORDER BY ex.created_at DESC LIMIT 10 ";

        $data['id_user'] = Session::get('userId');
        return $this->db->read($sql, $data);
    }

    
    public function getRecurentExpenses()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, categories.name AS category_name, recurences.period FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        WHERE ex.id_user = :id_user AND ex.id_recurence IS NOT NULL ORDER BY ex.created_at DESC LIMIT 10 ";

        $data['id_user'] = Session::get('userId');
        return $this->db->read($sql, $data);
    }


    public function create($data)
    {
        $sql = "INSERT INTO expenses(name, amount, created_at, id_category, id_recurence, id_user) 
        VALUES (:name, :amount, :created_at, :id_category, :id_recurence, :id_user)";

        $data['id_user'] = Session::get("userId");
        return $this->db->write($sql, $data);
    }


    public function update($id, $name, $amount, $date, $category, $period, $recurrence)
    {
        if (empty($name) || empty($amount) || empty($category)) {
            return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
        }

        $sql = "UPDATE expenses SET name = :name, amount=:amount, created_at=:created_at, period=:period, recurrence=:recurrence, id_category=:id_category WHERE id_expense = :id_expense";

        $data = [
            "id_expense" => $id, "name" => $name,
            "amount" => $amount, "created_at" => $date, "id_category" => $category, "period" => $period, "recurrence" => $recurrence
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


    public function selectExpensesRecurentes()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.period, categories.name AS category_name FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        WHERE ex.recurrence = 1 AND ex.id_user = :id_user";

        $data['id_user'] = Session::get('userId');
        return $this->db->read($sql, $data);
    }


    public function delete($id)
    {
        $sql = "DELETE FROM expenses WHERE id_expense = :id_expense";
        return $this->db->write($sql, ["id_expense" => $id]);
    }
}
