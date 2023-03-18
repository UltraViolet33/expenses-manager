<?php require_once '../../inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryController->add();
}

?>
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 mb-3">
            <h1>Ajouter une catégorie de dépense</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nom de la catégorie</label>
                    <input type="text" id="category_name" name="category_name" class="form-control">
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