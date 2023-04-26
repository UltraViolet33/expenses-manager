<?php require_once '../../inc/header.php';

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: allCategories.php");
}
$category = $categoryController->getSingle($_GET["id"]);
$expenses = $categoryController->getExpensesByCategory($_GET["id"]);

$total = 0;

foreach ($expenses as $expense) {
    $total += $expense->amount;
}

?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div>
            <h2>30 Dernières dépenses pour la catégorie : <?= $category->name ?></h2>
            <h3>Total : <?= $total ?> €</h3>
        </div>
        <?php if ($expenses) : ?>
            <div class="col-12 col-md-9 my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $expense) : ?>
                            <tr>
                                <th scope="row"><?= $expense->id_expense ?></th>
                                <td><?= $expense->expense_name ?></td>
                                <td><?= $expense->amount ?> €</td>
                                <td><?= $expense->created_at ?></td>
                                <td><a href="/expenses/editExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="/expenses/deleteExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this expense ?')">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <h2>Pas de dépense récurrentes</h2>
        <?php endif; ?>
    </div>
</div>
<?php require_once '../../inc/footer.php';
