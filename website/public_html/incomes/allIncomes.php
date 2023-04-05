<?php require_once '../../inc/header.php';

$allIncomes = $incomeController->getAllIncomes();
$recurentIncomes = $allIncomes[1];
$otherIncomes = $allIncomes[0];
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div>
            <h2>Revenus récurrents</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($recurentIncomes) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Period</th>
                            <th scope="col">Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recurentIncomes as $income) : ?>
                            <tr>
                                <th scope="row"><?= $income->id_income ?></th>
                                <td><?= $income->income_name ?></td>
                                <td><?= $income->amount ?> €</td>
                                <td><?= $income->period ?></td>
                                <td><?= $income->created_at ?></td>
                                <td><a href="/incomes/editIncome.php?id=<?= $income->id_income ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="/incomes/deleteIncome.php?id=<?= $income->id_income ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this expense ?')">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas de revenus récurents</h2>
            <?php endif; ?>
        </div>
        <div>
            <h2>Autres revenus</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($otherIncomes) : ?>
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
                        <?php foreach ($otherIncomes as $income) : ?>
                            <tr>
                                <th scope="row"><?= $income->id_income ?></th>
                                <td><?= $income->income_name ?></td>
                                <td><?= $income->amount ?> €</td>
                                <td><?= $income->created_at ?></td>
                                <td><a href="editIncome.php?id=<?= $income->id_income ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="deleteIncome.php?id=<?= $income->id_income ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this expense ?')">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas d'autres revenus</h2>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once '../../inc/footer.php' ?>