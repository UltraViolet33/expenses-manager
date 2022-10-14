<?php require_once '../inc/header.php'; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Ajouter une dépense</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control">
                </div>
                <div class="mb-3">
                    <select class="form-select" id="floatingSelect">
                        <option selected>Catégories</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>