<?php

require_once __DIR__ . "/../models/Expense.php";


class ExpenseController
{
    private Expense $expenseModel;

    public function __construct()
    {
        $this->expenseModel = new Expense();
    }


    public function getSingleExpense(int $id)
    {
        return $this->expenseModel->selectExpenseById($id);
    }


    public function edit(int $id)
    {
        $dataToCheck = ["name", "amount", "category"];

        if ($this->checkPostValues($dataToCheck)) {

            $data['created_at'] = $_POST['created_at'];

            if (isset($_POST['recurrence'])) {
                $data['id_recurence'] = $_POST['period'];
            } else {
                $data['id_recurence'] = null;
            }

            $data['name'] = $_POST['name'];
            $data['amount'] = $_POST['amount'];
            $data['id_category'] = $_POST['category'];
            $data['id_expense'] = $id;

            $this->expenseModel->update($data);
            header("Location: /expenses/allExpenses.php");
            Session::set("message", "OK !");

            return true;
        }

        Session::set("error", "missing fields !");
        return false;
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


    public function delete(int $id)
    {
        return $this->expenseModel->delete($id);
    }


    public function getExpensesGroupByMonthAndCategory()
    {
        return $this->expenseModel->selectExpensesGroupByMonthAndCategory();
    }


    public function resetStatusRecurentExpenses()
    {
        return $this->expenseModel->resetStatusRecurentExpenses();
    }

    public function getLeftRecurentExpenses()
    {
        return $this->expenseModel->getLeftRecurentExpenses();
    }


    public function getTotalRecurentExpenses(): float
    {
        $recurentExpenses = $this->getAllRecurentExpenses();
        $totalExpenses = 0;

        foreach ($recurentExpenses as $expense) {
            $totalExpenses += $expense->amount;
        }

        return $totalExpenses;
    }


    public function validateExpense(array $data)
    {
        $this->expenseModel->validate($data);
        $expense = $this->getSingleExpense($data["id_expense"]);

        $newExpense = [
            "name" => $expense->expense_name, "amount" => $expense->amount,
            "created_at" => Date('Y-m-d'), "id_category" => $expense->id_category,
            "id_recurence" => null, "status" => null
        ];

        $this->expenseModel->create($newExpense);
    }


    public function getExpensesByMonth(int $month)
    {
        return $this->expenseModel->getExpensesByMonth($month);
    }

    
    public function getExpensesPastWeek()
    {
        return $this->expenseModel->selectExpensesPastWeek();
    }
    

    public function getMonthExpensesGroupByCategories(int $month)
    {
        return $this->expenseModel->selectMonthExpensesGroupByCategories($month);
    }
}
