<?php require_once '../inc/header.php';
$recurentExpenses = $expense->getRecurentExpenses();

?>
<?php if (!Session::get('userId')) : ?>
    <script>
        location.replace("login.php")
    </script>
<?php endif; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Bienvenue <?= Session::get('username') ?></h1>
        </div>
        <div>
            <h2>Total des dépenses : €</h2>
        </div>
        <div class="col-12 col-md-9 my-5">
            <?php if ($recurentExpenses) : ?>
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
                        <?php foreach ($recurentExpenses as $expense) : ?>
                            <tr>
                                <th scope="row"><?= $expense->id_expense ?></th>
                                <td><?= $expense->expense_name ?></td>
                                <td><?= $expense->amount ?></td>
                                <td><?= $expense->period ?></td>
                                <td><?= $expense->created_at ?></td>
                                <td><a href="editExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="deleteExpense.php?id=<?= $expense->id_expense ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this expense ?')">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>Pas de dépenses</h2>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-9 my-5">

        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>