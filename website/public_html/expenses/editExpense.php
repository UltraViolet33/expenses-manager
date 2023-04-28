<?php require_once '../../inc/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$script = "../assets/js/expenseForm.js";

$categories = $categoryController->getAll();
$allRecurences = $recurenceController->getAll();

$singleExpense = $expenseController->getSingleExpense($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $expenseController->edit($singleExpense->id_expense);
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Editer une dépense</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="<?= $singleExpense->expense_name ?>">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant</label>
                    <input type="number" step=".01" name="amount" class="form-control" value="<?= $singleExpense->amount ?>">
                </div>
                <?php if ($singleExpense->id_recurence != NULL) : ?>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="true" name="recurrence" id="inputRecurrence" checked>
                        <label class="form-check-label" for="recurence">
                            Dépense récurrent
                        </label>
                    </div>
                    <div class="mb-3" id="period">
                        <select class="form-select" name="period">
                            <?php foreach ($allRecurences as $recurence) : ?>
                                <?php if ($recurence->id_recurence == $singleExpense->id_recurence) : ?>
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
                        <input type="date" name="created_at" class="form-control" value="<?= $singleExpense->created_at?>">
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <select class="form-select" name="category" id="categories-select">
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category->name == $singleExpense->category_name) : ?>
                                <option selected value="<?= $category->id_category ?>"><?= $category->name ?></option>
                            <?php else : ?>
                                <option value="<?= $category->id_category ?>"><?= $category->name ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../../inc/footer.php' ?>