<?php require_once '../inc/header.php';

$actualMonth = date('m');
$monthDB = $helperClass->getMonthDB();
// $wallet = $helperClass->getActualWallet();

if ($actualMonth > $monthDB->actual_month) {

    $data = [
        "actual_month" => $actualMonth,
        "old_month" => $monthDB->actual_month
    ];

    $helperClass->updateMonth($data);

    $expenseController->resetStatusRecurentExpenses();
    $incomeController->resetStatusRecurentIncomes();
    $actualAmount = $helperClass->getAmountByMonth($monthDB->actual_month);
    $data = [
        "month" => $actualMonth,
        "amount" => $actualAmount->amount
    ];

    $helperClass->insertNewAmount($data);
}


// $recurentExpenseLeft = $expenseController->getLeftRecurentExpenses();
$recurentExpenses = $expenseController->getAllRecurentExpenses();
// $recurentIncomesLeft = $incomeController->getLeftRecurentIncomes();
$recurentIncomes = $incomeController->getRecurentIncomes();

// $totalRecurentExpenses = $expenseController->getTotalRecurentExpenses();
// $totalRecurentIncomes = $incomeController->getTotalRecurentIncomes();

// $balance = $totalRecurentIncomes - $totalRecurentExpenses;
// $balance = $balance > 0 ? "+ " . $balance : $balance;
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- <h1>Portefeuille : <?= $wallet->amount ?> €</h1> -->
            <!-- <h2>Balance : <?= $balance ?> €</h2> -->
            <!-- <h2>Total dépenses récurrentes : <?= $totalRecurentExpenses ?> €</h2> -->
            <!-- <h2>Total revenus récurrents : <?= $totalRecurentIncomes ?> €</h2> -->
        </div>
        <?php if ($recurentExpenses) : ?>
            <div>
                <h2>Dépenses récurrentes restantes pour le mois actuel</h2>
            </div>
            <div class="col-12 col-md-9 my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recurentExpenses as $expense) : ?>
                            <tr>
                                <th scope="row"><?= $expense->id_expense ?></th>
                                <td><?= $expense->expense_name ?></td>
                                <td><?= $expense->amount ?></td>
                                <?php if ($expense->status == 0) : ?>
                                    <td><a href="expenses/validateExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-primary">Valider</a></td>
                                <?php else : ?>
                                    <td>Déjà Validé</td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="m-5">
                <h2>Toutes les dépenses récurrentes ont été effectuées !</h2>
            </div>
        <?php endif; ?>
        <?php if ($recurentIncomes) : ?>
            <div>
                <h2>Revenus récurrents restants pour le mois actuel</h2>
            </div>
            <div class="col-12 col-md-9 my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recurentIncomes as $income) : ?>
                            <tr>
                                <th scope="row"><?= $income->id_income ?></th>
                                <td><?= $income->income_name ?></td>
                                <td><?= $income->amount ?></td>
                                <?php if ($income->status === 0) : ?>
                                    <td><a href="incomes/validateIncome.php?id=<?= $income->id_income ?>" class="btn btn-primary">Valider</a></td>
                                <?php else : ?>
                                    <td>Déjà Validé</td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="m-5">
                <h2>Tout les revenus récurrents ont été effectués !</h2>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>