<?php

require_once __DIR__ . "/../connection/Database.php";


class Expense
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function selectAll(): array
    {
        $sql = "SELECT * FROM expenses";
        return $this->db->read($sql);
    }


    public function selectExpenseById(int $id)
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.id_recurence, ex.created_at, 
        categories.name AS category_name, categories.id_category FROM expenses AS ex 
        INNER JOIN categories ON ex.id_category = categories.id_category 
        WHERE id_expense = :id_expense";

        return $this->db->readOneRow($sql, ["id_expense" => $id]);
    }


    public function create(array $data)
    {
        $sql = "INSERT INTO expenses(name, amount, created_at, id_category, id_recurence, status) 
        VALUES (:name, :amount, :created_at, :id_category, :id_recurence, :status)";

        $this->db->write($sql, $data);

        if ($data['id_recurence'] == null) {
            $sql = "UPDATE wallet SET amount = amount - :expense ORDER BY id DESC LIMIT 1";

            $this->db->write($sql, ["expense" => $data['amount']]);
        }
    }


    public function selectRecurentExpenses(): array
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name,ex.status, ex.amount, ex.created_at, 
        categories.name AS category_name, recurences.period FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        WHERE ex.id_recurence IS NOT NULL";

        return $this->db->read($sql);
    }

    public function getExpensesByMonth(int $month)
    {
        $sql = "SELECT cat.name AS category_name, ex.id_expense, ex.name AS expense_name, 
        ex.amount, ex.created_at FROM expenses AS ex 
        JOIN categories AS cat ON ex.id_category = cat.id_category 
        WHERE ex.id_recurence IS NULL AND ex.created_at LIKE  :date";

        $month = $month > 9 ? $month : "0" . $month;
        return $this->db->read($sql, ["date" => date("Y") . "-$month-%"]);
    }

    public function selectExpensesPastWeek(): array
    {
        $sql = "SELECT cat.name AS category_name, ex.id_expense, ex.name AS expense_name, 
        ex.amount, ex.created_at FROM expenses AS ex 
        JOIN categories AS cat ON ex.id_category = cat.id_category 
        WHERE ex.id_recurence IS NULL AND ex.created_at BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";

        return $this->db->read($sql);
    }


    public function selectNonRecurenceExpenses(): array
    {
        $sql = "SELECT cat.name AS category_name, ex.id_expense, ex.name AS expense_name, 
        ex.amount, ex.created_at FROM expenses AS ex 
        JOIN categories AS cat ON ex.id_category = cat.id_category 
        WHERE ex.id_recurence IS NULL ORDER BY ex.created_at DESC LIMIT 30";

        return $this->db->read($sql);
    }


    public function getExpensesByCategory(int $idCategory): array
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, 
        ex.amount, ex.created_at FROM expenses AS ex 
        JOIN categories AS cat ON ex.id_category = cat.id_category 
        WHERE ex.id_recurence IS NULL AND ex.id_category = :id_category
         ORDER BY ex.created_at DESC LIMIT 30";

        return $this->db->read($sql, ["id_category" => $idCategory]);
    }


    public function update(array $data)
    {
        $sql = "UPDATE expenses SET name = :name, amount = :amount, created_at = :created_at, 
        id_recurence = :id_recurence, id_category = :id_category WHERE id_expense = :id_expense";
        return $this->db->write($sql, $data);
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM expenses WHERE id_expense = :id_expense";
        return $this->db->write($sql, ["id_expense" => $id]);
    }


    public function selectExpensesGroupByMonthAndCategory()
    {
        $sql = "SELECT DATE_FORMAT(ex.created_at, '%M %Y') AS month, ex.id_category, 
        cat.name AS category_name,  SUM(ex.amount) AS total_expenses FROM expenses AS ex 
        INNER JOIN categories AS cat ON cat.id_category = ex.id_category WHERE ex.id_recurence IS NULL
        GROUP BY DATE_FORMAT(ex.created_at, '%M %Y'), ex.id_category  ORDER BY STR_TO_DATE(CONCAT( month, ' 01'), '%M %Y %d') DESC, total_expenses DESC";
        return $this->db->read($sql);
    }

    public function selectMonthExpensesGroupByCategories(int $month)
    {
        $month = $month > 9 ? $month : "0" . $month;

        $sql = "SELECT ex.id_category, cat.name AS category_name, SUM(ex.amount) AS total_expenses FROM expenses AS ex 
        INNER JOIN categories AS cat ON cat.id_category = ex.id_category WHERE ex.id_recurence IS NULL and ex.created_at LIKE :date
        GROUP BY ex.id_category ORDER BY total_expenses DESC";
        return $this->db->read($sql, ["date" => date("Y") . "-$month-%"]);
    }

    public function resetStatusRecurentExpenses()
    {
        $sql = "UPDATE expenses SET status = 0 WHERE id_recurence IS NOT NULL";
        return $this->db->write($sql);
    }

    public function getLeftRecurentExpenses()
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount FROM expenses AS ex
        INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        WHERE ex.id_recurence IS NOT NULL AND ex.status = 0";
        return $this->db->read($sql);
    }


    public function validate(array $data)
    {
        $sql = "UPDATE expenses SET status = 1 WHERE id_expense = :id_expense";
        return $this->db->write($sql, $data);
    }
}
