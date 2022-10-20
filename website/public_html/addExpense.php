<?php require_once '../inc/header.php';
$categories = $category->getAll();
$script = "addCategory.js";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $format->validation($_POST['name']);
    $amount = $format->validation($_POST['amount']);
    $category = $format->validation($_POST['category']);
    $expense->create($name, $amount, $category);
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
                    <input type="number" name="amount" class="form-control">
                </div>
                <div class="mb-3">
                    <select class="form-select" name="category" id="categories-select">
                        <option selected>Catégories</option>
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