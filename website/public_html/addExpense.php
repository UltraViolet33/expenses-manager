<?php require_once '../inc/header.php';

$categories = $category->getAll();
$script = "addCategory.js";

$script2 = "formRecurence.js";

$allRecurences = $recurenceModel->getAll();

if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $data = [];

    if (isset($_POST['recurrence'])) {
        $data['created_at'] = Date('Y-m-d');
        $data['id_recurence'] = $_POST['period'];
        $data['status'] = 0;
    } else {
        $data['created_at'] = $_POST['created_at'];
        $data['id_recurence'] = null;
        $data['status'] = null;

    }

    $data['name'] = $format->validation($_POST['name']);
    $data['amount'] = $format->validation($_POST['amount']);
    $data['id_category'] = $format->validation($_POST['category']);
    $expense->create($data);
    echo "<script>location.replace('/')</script>";
}
?>
<?php if (!Session::get('userId')) : ?>
    <script>
        location.replace("login.php")
    </script>
<?php endif; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 mb-3">
            <h1>Ajouter une catégorie de dépense</h1>
            <form>
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nom de la catégorie</label>
                    <input type="text" id="category_name" name="category_name" class="form-control">
                </div>
                <button id="btn-submit-cat" class="btn btn-primary">Valider</button>
                <div id="message">

                </div>
            </form>
        </div>
        <div class="col-12 col-md-8">
            <h1>Ajouter une dépense</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant</label>
                    <input type="number" step=".01" name="amount" class="form-control">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="true" name="recurrence" id="inputRecurrence">
                    <label class="form-check-label" for="recurence">
                        Dépense récurrent
                    </label>
                </div>
                <div class="mb-3" id="date">
                    <label for="created_at" class="form-label">Date</label>
                    <input type="date" name="created_at" class="form-control">
                </div>
                <div class="mb-3" id="period" style="display:none">
                    <select class="form-select" name="period">
                        <?php foreach ($allRecurences as $recurence) : ?>
                            <option value="<?= $recurence->id_recurence ?>"><?= $recurence->period ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="category" id="categories-select">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id_category ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>