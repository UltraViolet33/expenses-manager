<?php require_once '../../inc/header.php';

$script = "../assets/js/formRecurence.js";

$allRecurences = $recurenceController->getAll();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $incomeController->add();
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Add an income</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_POST['name']) ? $_POST['name'] : null ?>">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step=".01" name="amount" class="form-control" value="<?= isset($_POST['amount']) ? $_POST['amount'] : null ?>">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="true" name="recurrence" id="inputRecurrence">
                    <label class="form-check-label" for="recurence">
                        Recurent Income
                    </label>
                </div>
                <div class="mb-3" id="date">
                    <label for="created_at" class="form-label">Date</label>
                    <input type="date" name="created_at" class="form-control" value="<?= isset($_POST['created_at']) ? $_POST['created_at'] : null ?>">
                </div>
                <div class="mb-3" id="period" style="display:none">
                    <select class="form-select" name="period">
                        <?php foreach ($allRecurences as $recurence) : ?>
                            <option value="<?= $recurence->id_recurence ?>"><?= $recurence->period ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../../inc/footer.php' ?>