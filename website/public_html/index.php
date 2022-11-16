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
            <h1>Bienvjnue <?= Session::get('username') ?></h1>
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>