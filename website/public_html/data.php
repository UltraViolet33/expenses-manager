<?php require_once '../inc/header.php';

$script = "assets/js/data.js";

$allExpenses = $expenseController->getExpensesGroupByMonthAndCategory();

$allMonths = [];
if ($allExpenses) {

    foreach ($allExpenses as $ex) {
        if (!in_array($ex->month, $allMonths)) {
            $allMonths[$ex->month] =  0;
        }
    }

    foreach ($allExpenses as $ex) {
        foreach ($allMonths as $month => $e) {
            if ($ex->month == $month) {
                $allMonths[$month] += $ex->total_expenses;
            }
        }
    }
}
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 my-5">
            <?php if ($allExpenses) : ?>
                <?php foreach ($allMonths as $month => $e) : ?>
                    <div class="my-5">

                        <h3 style="cursor:pointer" class="months" month="<?= $month ?>"><?= $month ?> | Total : <?= $e ?> €</h3>
                        <div style="display:none" id="<?= $month ?>">
                            <table class="table my-4">
                                <thead>
                                    <tr>
                                        <th scope="col">Categorie</th>
                                        <th scope="col">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allExpenses as $ex) : ?>
                                        <?php if ($ex->month == $month) : ?>
                                            <tr>
                                                <th scope="row"><?= $ex->category_name ?></th>
                                                <td><?= $ex->total_expenses ?> €</td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No history</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>