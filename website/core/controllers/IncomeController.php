<?php

require_once __DIR__ . "/../models/Income.php";


class IncomeController
{

    private Income $incomeModel;

    public function __construct()
    {
        $this->incomeModel = new Income();
    }


    public function delete(int $id)
    {
        $this->incomeModel->delete($id);
    }

    public function getAllIncomes(): array
    {
        $allRecurentIncomes = $this->incomeModel->selectRecurentIncomes();
        $nonRecurentIncomes = $this->incomeModel->selectNonRecurentIncomes();

        return [$nonRecurentIncomes, $allRecurentIncomes];
    }


    public function getSingleIncome(int $id)
    {
        return $this->incomeModel->selectSingleIncome($id);
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


    public function edit(int $id)
    {
        $dataToCheck = ["name", "amount"];

        if ($this->checkPostValues($dataToCheck)) {

            // $data['created_at'] = Date('Y-m-d');
            $data['created_at'] = Date('Y-m-d');

            if (isset($_POST['recurrence'])) {
                $data['id_recurence'] = $_POST['period'];
            } else {

                if (isset($_POST["created_at"]) && !empty($_POST["created_at"])) {
                    $data['created_at'] = $_POST['created_at'];
                }

                $data['id_recurence'] = null;
            }

            $data['name'] = $_POST['name'];
            $data['amount'] = $_POST['amount'];
            $data["id_income"] = $id;

            $this->incomeModel->update($data);
            header("Location: /incomes/allIncomes.php");
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

    public function resetStatusRecurentIncomes()
    {
        return $this->incomeModel->resetStatusRecurentIncomes();
    }

    public function getLeftRecurentIncomes()
    {
        return $this->incomeModel->getLeftRecurentIncomes();
    }
}
