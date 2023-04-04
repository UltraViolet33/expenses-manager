<?php

require_once __DIR__ . "/../models/Income.php";


class IncomeController
{

    private Income $incomeModel;

    public function __construct()
    {
        $this->incomeModel = new Income();
    }


    public function add()
    {
        $dataToCheck = ["name", "amount"];

        if ($this->checkPostValues($dataToCheck)) {

            $data['created_at'] = Date('Y-m-d');

            if (isset($_POST['recurrence'])) {
                $data['id_recurence'] = $_POST['period'];
                $data['status'] = 0;
            } else {

                if (isset($_POST["created_at"]) && !empty($_POST["created_at"])) {
                    $data['created_at'] = $_POST['created_at'];
                }

                $data['id_recurence'] = null;
                $data['status'] = null;
            }

            $data['name'] = $_POST['name'];
            $data['amount'] = $_POST['amount'];

            $this->incomeModel->create($data);
            // header("Location: /incomes/allIncomes.php");
            Session::set("message", "OK !");

            return true;
        }

        Session::set("error", "missing fields !");
        return false;
    }


    protected function checkPostValues(array $values): bool
    {
        foreach ($values as $value) {
            if (!isset($_POST[$value]) || $_POST[$value] == "") {
                return false;
            }
        }

        return true;
    }
}
