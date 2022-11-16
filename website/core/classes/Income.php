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

    public function create($data)
    {
    
        if (empty($data['name']) || empty($data['amount']) || empty($data['created_at'])) {
            return $this->helper->alertMessage('danger', 'Empty field', 'Please fill all fields');
        }

        $sql = "INSERT INTO incomes (name, amount, created_at, id_user, id_recurence) VALUES (:name, :amount, :created_at, :id_user, :id_recurence)";

        $data['id_user'] = Session::get('userId');
        return $this->db->write($sql, $data);
    }


    public function selectRecurentIncomes()
    {
        $sql = "SELECT inc.id_income, inc.name AS income_name, inc.amount, inc.created_at, recurences.period FROM incomes AS inc 
        INNER JOIN recurences ON recurences.id_recurence = inc.id_recurence WHERE inc.id_recurence IS NOT NULL;";

        return $this->db->read($sql);
    }

}