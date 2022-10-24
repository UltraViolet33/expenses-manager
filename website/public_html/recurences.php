<?php require_once '../inc/header.php';

$expensesRecurentes = $expense->selectExpensesRecurentes();
$totalExpenses = 0;

if ($expensesRecurentes) {

    foreach ($expensesRecurentes as $expense) {
        $totalExpenses += $expense->amount;
    }
}
?>
<?php if (!Session::get('userId')) : ?>
    <script>
        location.replace("login.php")
    </script>
<?php endif; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div>
            <h2>Total des dépenses récurrentes: <?= $totalExpenses ?> €</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($expensesRecurentes) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Period</th>
                            <th scope="col">Catégorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expensesRecurentes as $expense) : ?>
                            <tr>
                                <th scope="row"><?= $expense->id_expense ?></th>
                                <td><?= $expense->expense_name ?></td>
                                <td><?= $expense->amount ?></td>
                                <td><?= $expense->period ?></td>
                                <td><?= $expense->category_name ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas de dépenses récurrentes</h2>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>