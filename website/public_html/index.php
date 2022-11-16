<?php require_once '../inc/header.php';

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
           
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>