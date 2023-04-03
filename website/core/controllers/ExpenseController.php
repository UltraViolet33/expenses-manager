<?php

require_once __DIR__ . "/../models/Expense.php";


class ExpenseController
{

    private Expense $expenseModel;

    public function __construct()
    {
        $this->expenseModel = new Expense();
    }


    public function add()
    {
        $dataToCheck = ["name", "amount", "category"];

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
            $data['id_category'] = $_POST['category'];

            $this->expenseModel->create($data);
            header("Location: /expenses/allExpenses.php");
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


    public function getAllRecurentExpenses(): array
    {
        return $this->expenseModel->selectRecurentExpenses();
    }


    public function getNonRecurentExpenses(): array
    {
        return $this->expenseModel->selectNonRecurenceExpenses();
    }
}
