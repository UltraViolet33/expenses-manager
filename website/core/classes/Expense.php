<?php
require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";


class Expenses
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
     * @return object
     */
    public function getSingleExpense($id)
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.id_recurence, ex.created_at, 
        categories.name AS category_name, categories.id_category FROM expenses AS ex 
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
        // $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, 
        // categories.name AS category_name, recurences.period FROM expenses AS ex
        // INNER JOIN categories ON ex.id_category = categories.id_category  
        // INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        // WHERE ex.id_recurence IS NOT NULL ORDER BY ex.created_at DESC LIMIT 10 ";
        // return $this->db->read($sql);
    }


    public function getLeftRecurentExpenses()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount FROM expenses AS ex
        INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        WHERE ex.id_recurence IS NOT NULL AND ex.status = 0";
        return $this->db->read($sql);
    }


    public function validate($data)
    {
        $sql = "UPDATE expenses SET status = 1 WHERE id_expense = :id_expense";
        return $this->db->write($sql, $data);
    }


    public function create($data)
    {

        $sql = "INSERT INTO expenses(name, amount, created_at, id_category, id_recurence, status) 
        VALUES (:name, :amount, :created_at, :id_category, :id_recurence, :status)";
        
         $this->db->write($sql, $data);


         if($data['id_recurence'] == null)
         {
            $sql = "UPDATE wallet SET amount = amount - :expense ORDER BY id DESC LIMIT 1";

            $this->db->write($sql, ["expense" => $data['amount']]);
            
         }
    }


    public function update($data)
    {
        $sql = "UPDATE expenses SET name = :name, amount=:amount, created_at=:created_at, 
        id_recurence=:id_recurence, id_category=:id_category WHERE id_expense = :id_expense";
        return $this->db->write($sql, $data);
    }

    public function resetStatusRecurentExpenses()
    {
        $sql = "UPDATE expenses SET status = 0 WHERE id_recurence IS NOT NULL";
        return $this->db->write($sql);
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
