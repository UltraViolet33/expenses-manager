<?php
require_once __DIR__ . "/../helpers/Helper.php";
require_once __DIR__ . "/../connection/Database.php";
require_once __DIR__ . "/../connection/Session.php";


class Income
{
    private $helper;
    private $db;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->db = new Database();
    }

    // public function create($data)
    // {

    //     if (empty($data['name']) || empty($data['amount']) || empty($data['created_at'])) {
    //         return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
    //     }

    //     $sql = "INSERT INTO incomes (name, amount, created_at, id_recurence, status) VALUES (:name, :amount, :created_at, :id_recurence, :status)";
    //     $this->db->write($sql, $data);

        
    //     if($data['id_recurence'] == null)
    //     {
    //        $sql = "UPDATE wallet SET amount = amount + :income ORDER BY id DESC LIMIT 1";

    //        $this->db->write($sql, ["income" => $data['amount']]);
           
    //     }
    // }


    // public function selectRecurentIncomes()
    // {
    //     $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, recurences.period FROM incomes AS inc 
    //     INNER JOIN recurences ON recurences.id_recurence = inc.id_recurence WHERE inc.id_recurence IS NOT NULL;";

    //     return $this->db->read($sql);
    // }


    // public function selectIncomes()
    // {
    //     $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at FROM incomes AS inc WHERE inc.id_recurence IS  NULL;";
    //     return $this->db->read($sql);
    // }


    public function getSingleRecurentIncome($id)
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, recurences.period FROM incomes AS inc 
        INNER JOIN recurences ON recurences.id_recurence = inc.id_recurence WHERE inc.id_income = :id_income";

        return $this->db->readOneRow($sql, ["id_income" => $id]);
    }


    public function getSingleIncome($id)
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, inc.id_recurence FROM incomes AS inc 
       WHERE inc.id_income = :id_income";

        return $this->db->readOneRow($sql, ["id_income" => $id]);
    }

    
    public function update($data)
    {
        var_dump($data);
        $sql = "UPDATE incomes SET name = :name, amount = :amount, created_at = :created_at, id_recurence = :id_recurence WHERE id_income = :id_income";
        return $this->db->write($sql, $data);
    }


    public function delete($id)
    {
        $sql = "DELETE FROM incomes WHERE id_income = :id_income";
        return $this->db->write($sql, ["id_income" => $id]);
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

    public function resetStatusRecurentIncomes()
    {
        $sql = "UPDATE incomes SET status = 0 WHERE id_recurence IS NOT NULL";
        $this->db->write($sql);
    }
}
