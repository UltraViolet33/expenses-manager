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
}
