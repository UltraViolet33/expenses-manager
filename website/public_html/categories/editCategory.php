<?php require_once '../../inc/header.php';


if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: allCategories.php");
}

$category = $categoryController->getSingle($_GET["id"]);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryController->edit();
}

?>
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 mb-3">
            <h1>Edit category : <?= $category->name ?></h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nom de la catégorie</label>
                    <input type="text" value="<?= $category->name ?>" id="category_name" name="category_name" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="hidden" value="<?= $category->id_category ?>" name="category_id">
                </div>
                <button class="btn btn-primary">Valider</button>
            </form>
            <div class="bg-danger">
                <?php
                echo Session::get("error");
                Session::unsetKey("error");
                ?>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../inc/footer.php' ?>