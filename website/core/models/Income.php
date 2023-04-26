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


        if ($data['id_recurence'] == null) {
            $sql = "UPDATE wallet SET amount = amount + :income ORDER BY id DESC LIMIT 1";

            $this->db->write($sql, ["income" => $data['amount']]);
        }
    }


    public function selectRecurentIncomes(): array
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.status, inc.amount, inc.created_at, recurences.period FROM incomes AS inc 
        INNER JOIN recurences ON recurences.id_recurence = inc.id_recurence WHERE inc.id_recurence IS NOT NULL;";

        return $this->db->read($sql);
    }


    public function selectNonRecurentIncomes(): array
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at FROM incomes AS inc 
        WHERE inc.id_recurence IS  NULL LIMIT 30";
        return $this->db->read($sql);
    }


    public function selectSingleIncome($id)
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, inc.id_recurence FROM incomes AS inc 
       WHERE inc.id_income = :id_income";

        return $this->db->readOneRow($sql, ["id_income" => $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM incomes WHERE id_income = :id_income";
        return $this->db->write($sql, ["id_income" => $id]);
    }


    public function update(array $data)
    {
        var_dump($data);
        $sql = "UPDATE incomes SET name = :name, amount = :amount, created_at = :created_at, id_recurence = :id_recurence WHERE id_income = :id_income";
        return $this->db->write($sql, $data);
    }

    public function resetStatusRecurentIncomes()
    {
        $sql = "UPDATE incomes SET status = 0 WHERE id_recurence IS NOT NULL";
        $this->db->write($sql);
    }

    public function getLeftRecurentIncomes()
    {
        $sql = "SELECT id_income, name, amount FROM incomes
        WHERE id_recurence IS NOT NULL AND status = 0";
        return $this->db->read($sql);
    }


    public function validate($data)
    {
        $sql = "UPDATE incomes SET status = 1 WHERE id_income = :id_income";
        return $this->db->write($sql, $data);
    }
}
