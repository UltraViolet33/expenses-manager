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

    
    /**
     * getSingleExpense
     * get an expense by id
     * @param  mixed $id
     * @return void
     */
    public function getSingleExpense($id)
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.id_recurence, ex.created_at, 
        categories.name AS category_name FROM expenses AS ex 
        INNER JOIN categories ON ex.id_category = categories.id_category 
        WHERE id_expense = :id_expense";
        return $this->db->readOneRow($sql, ["id_expense" => $id]);
    }


    // public function select()
    // {
    //     $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, 
    //     categories.name AS category_name FROM expenses AS ex
    //     INNER JOIN categories ON ex.id_category = categories.id_category  
    //     WHERE ex.id_user = :id_user AND ex.recurrence = 0 ORDER BY ex.created_at DESC LIMIT 10 ";
    //     $data['id_user'] = Session::get('userId');
    //     return $this->db->read($sql, $data);
    // }


    public function getRecurentExpenses()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, 
        categories.name AS category_name, recurences.period FROM expenses AS ex
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


    public function update($data)
    {
        $sql = "UPDATE expenses SET name = :name, amount=:amount, created_at=:created_at, 
        id_recurence=:id_recurence, id_category=:id_category WHERE id_expense = :id_expense";
        return $this->db->write($sql, $data);
    }

    
    /**
     * selectExpensesGroupByMonthAndCategory
     * select all non recurence expenses group by month and categories
     * @return void
     */
    public function selectExpensesGroupByMonthAndCategory()
    {
        $sql = "SELECT DATE_FORMAT(ex.created_at, '%M') AS month, ex.id_category, 
        cat.name AS category_name,  SUM(ex.amount) AS total_expenses FROM expenses AS ex 
        INNER JOIN categories AS cat ON cat.id_category = ex.id_category WHERE ex.id_recurence IS NULL
        GROUP BY DATE_FORMAT(ex.created_at, '%M'), ex.id_category";
        return $this->db->read($sql);
    }

    
    /**
     * getExpenses
     * get all expenses which are not recurents
     * @return object
     */
    public function getExpenses()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, 
        ex.created_at FROM expenses AS ex WHERE ex.id_recurence IS NULL";
        return $this->db->read($sql);
    }

    
    /**
     * delete
     * delete an expense by its id
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $sql = "DELETE FROM expenses WHERE id_expense = :id_expense";
        return $this->db->write($sql, ["id_expense" => $id]);
    }
}
