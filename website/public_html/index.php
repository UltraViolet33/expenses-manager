<?php require_once '../inc/header.php';

$actualMonth = date('F');
$wallet = $helperClass->getActualWallet();

$monthExpenses = $expenseController->getExpensesByMonth(date('m'));
$totalExpenses = 0;

foreach ($monthExpenses as $expense) {
    $totalExpenses += $expense->amount;
}

$totalIncomes = $incomeController->getTotalIncomesByMonth(date('m'));
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 align="center"><?= $actualMonth ?></h1>
            <h1>Portefeuille : <?= $wallet->amount ?> €</h1>
        </div>
        <div>
            <h3>Total de dépenses mois : <?= $totalExpenses ?> €</h3>
            <h3>Total de revenus mois : <?= $totalIncomes ?> €</h3>
            <h3>Balance : <?= $totalIncomes - $totalExpenses ?> €</h3>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>