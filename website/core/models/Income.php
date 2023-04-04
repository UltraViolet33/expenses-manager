<?php

require_once __DIR__ . "/../connection/Database.php";


class Income
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function create(array $data)
    {
        $sql = "INSERT INTO incomes (name, amount, created_at, id_recurence, status) VALUES (:name, :amount, :created_at, :id_recurence, :status)";
        $this->db->write($sql, $data);


        // if($data['id_recurence'] == null)
        // {
        //    $sql = "UPDATE wallet SET amount = amount + :income ORDER BY id DESC LIMIT 1";

        //    $this->db->write($sql, ["income" => $data['amount']]);

        // }
    }
}
