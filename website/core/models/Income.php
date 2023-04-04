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


    public function selectRecurentIncomes(): array
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, recurences.period FROM incomes AS inc 
        INNER JOIN recurences ON recurences.id_recurence = inc.id_recurence WHERE inc.id_recurence IS NOT NULL;";

        return $this->db->read($sql);
    }


    public function selectNonRecurentIncomes(): array
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at FROM incomes AS inc WHERE inc.id_recurence IS  NULL;";
        return $this->db->read($sql);
    }
}
