<?php require_once '../inc/header.php';

$actualMonth = date('m');

$monthDB = $helperClass->getMonthDB();

$wallet = $helperClass->getActualWallet();


if ($actualMonth > $monthDB->actual_month) {
    $data = [
        "actual_month" => $actualMonth,
        "old_month" => $monthDB->actual_month
    ];

    $helperClass->updateMonth($data);
    $expense->resetStatusRecurentExpenses();

    var_dump($monthDB);


    $actualAmount = $helperClass->getAmountByMonth($monthDB->actual_month);
    $data = [
        "month" => $actualMonth,
        "amount" => $actualAmount->amount
    ];

    $helperClass->insertNewAmount($data);
}

$recurentExpenseLeft = $expense->getLeftRecurentExpenses();
$recurentIncomesLeft = $incomeModel->getLeftRecurentIncomes();

?>
<?php if (!Session::get('userId')) : ?>
    <script>
        location.replace("login.php")
    </script>
<?php endif; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Bienjnue <?= Session::get('username') ?></h1>
            <h1>Bienjnue <?= $wallet->amount ?> €</h1>

        </div>
        <div>
            <h2>Dépenses récurrentes restantes pour le mois actuel</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($recurentExpenseLeft) : ?>
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
                        <?php foreach ($recurentExpenseLeft as $expense) : ?>
                            <tr>
                                <th scope="row"><?= $expense->id_expense ?></th>
                                <td><?= $expense->expense_name ?></td>
                                <td><?= $expense->amount ?></td>
                                <td><a href="validateExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-primary">Valider</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas de dépense récurrentes</h2>
            <?php endif; ?>
        </div>
        <div>
            <h2>Renenus récurrents restants pour le mois actuel</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($recurentIncomesLeft) : ?>
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
                        <?php foreach ($recurentIncomesLeft as $income) : ?>
                            <tr>
                                <th scope="row"><?= $income->id_income ?></th>
                                <td><?= $income->name ?></td>
                                <td><?= $income->amount ?></td>
                                <td><a href="validateIncome.php?id=<?= $income->id_income ?>" class="btn btn-primary">Valider</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas de dépense récurrentes</h2>
            <?php endif; ?>
        </div>
    </div>
    <?php require_once '../inc/footer.php' ?>