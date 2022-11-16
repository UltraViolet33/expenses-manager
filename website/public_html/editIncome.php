<?php require_once '../inc/header.php';

$allRecurences = $recurenceModel->getAll();
$script = "formRecurence.js";

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$singleIncome = $incomeModel->getSingleIncome($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $data = [];
    $data['id_income'] = $singleIncome->id_income;

    if (isset($_POST['recurrence'])) {

        $data['id_recurence'] = $_POST['period'];
        $data['created_at'] = Date('Y-m-d');
    } else {
        $data['id_recurence'] = null;
        $data['created_at'] = $_POST['created_at'];
    }


    $data['name'] = $format->validation($_POST['name']);
    $data['amount'] = $format->validation($_POST['amount']);
    $incomeModel->update($data);

    echo "<script>location.replace('/allIncomes.php')</script>";
}
?>
<?php if (!Session::get('userId')) : ?>
    <script>
        location.replace("login.php")
    </script>
<?php endif; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Edit an income</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $singleIncome->income_name ?>">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step=".01" name="amount" class="form-control" value="<?= $singleIncome->amount ?>">
                </div>
                <?php if ($singleIncome->id_recurence != NULL) : ?>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="true" name="recurrence" id="inputRecurrence" checked>
                        <label class="form-check-label" for="recurence">
                            Recurent Income
                        </label>
                    </div>
                    <div class="mb-3" id="period">
                        <select class="form-select" name="period">
                            <?php foreach ($allRecurences as $recurence) : ?>
                                <?php if ($recurence->id_recurence == $singleIncome->id_recurence) : ?>
                                    <option selected value="<?= $recurence->id_recurence ?>"><?= $recurence->period ?></option>
                                <?php else : ?>
                                    <option value="<?= $recurence->id_recurence ?>"><?= $recurence->period ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php else : ?>
                    <div class="mb-3" id="date">
                        <label for="created_at" class="form-label">Date</label>
                        <input type="date" name="created_at" class="form-control" value="<?= $singleIncome->created_at ?>">
                    </div>
                <?php endif; ?>
                <button class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>