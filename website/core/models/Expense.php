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

    
    public function create(array $data)
    {
        // var_dump($data);
        // die;

        $sql = "INSERT INTO expenses(name, amount, created_at, id_category, id_recurence, status) 
        VALUES (:name, :amount, :created_at, :id_category, :id_recurence, :status)";

        $this->db->write($sql, $data);

        //  if($data['id_recurence'] == null)
        //  {
        //     $sql = "UPDATE wallet SET amount = amount - :expense ORDER BY id DESC LIMIT 1";

        //     $this->db->write($sql, ["expense" => $data['amount']]);

        //  }
    }


    public function selectRecurentExpenses(): array 
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, ex.created_at, 
        categories.name AS category_name, recurences.period FROM expenses AS ex
        INNER JOIN categories ON ex.id_category = categories.id_category  
        INNER JOIN recurences ON recurences.id_recurence = ex.id_recurence
        WHERE ex.id_recurence IS NOT NULL";

        return $this->db->read($sql);
    }


    public function selectNonRecurenceExpenses(): array 
    {
        $sql = "SELECT ex.id_expense, ex.name AS expense_name, ex.amount, 
        ex.created_at FROM expenses AS ex WHERE ex.id_recurence IS NULL";
        
        return $this->db->read($sql);
    }
}
