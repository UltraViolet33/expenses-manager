<?php require_once '../inc/header.php';

$actualMonth = date('F');
$wallet = $helperClass->getActualWallet();

$monthExpenses = $expenseController->getExpensesByMonth(date('m'));
$totalExpenses = 0;

foreach ($monthExpenses as $expense) {
    $totalExpenses += $expense->amount;
}

$totalIncomes = $incomeController->getTotalIncomesByMonth(date('m'));
$expensesPastWeek = $expenseController->getExpensesPastWeek();

$totalWeek = 0;

foreach ($expensesPastWeek as $expense) {
    $totalWeek += $expense->amount;
}

$expensesMonthByCategories = $expenseController->getMonthExpensesGroupByCategories(date("m"));
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 align="center"><?= $actualMonth ?></h1>
            <h1>Portefeuille : <?= $wallet->amount ?> €</h1>
        </div>
        <div class="my-5">
            <h3>Total de dépenses mois : <?= $totalExpenses ?> €</h3>
            <h3>Total de revenus mois : <?= $totalIncomes ?> €</h3>
            <h3>Balance : <?= $totalIncomes - $totalExpenses ?> €</h3>
        </div>
        <div>
            <h3>
                Total des 7 derniers jours : <?= $totalWeek ?> €
            </h3>
            <div class="col-12 col-md-9 my-5">
                <?php if ($expensesPastWeek) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expensesPastWeek as $expense) : ?>
                                <tr>
                                    <th scope="row"><?= $expense->id_expense ?></th>
                                    <td><?= $expense->expense_name ?></td>
                                    <td><?= $expense->category_name ?></td>
                                    <td><?= $expense->amount ?> €</td>
                                    <td><?= $expense->created_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h2>Pas d'autres dépenses</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <h2>Dépenses du moi par catégories</h2>
        <div class="col-12">
            <?php if ($expensesMonthByCategories) : ?>
                <table class="table my-4">
                    <thead>
                        <tr>
                            <th scope="col">Categorie</th>
                            <th scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expensesMonthByCategories as $ex) : ?>
                            <tr>
                                <td><?= $ex->category_name ?></td>
                                <td><?= $ex->total_expenses ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No history</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>