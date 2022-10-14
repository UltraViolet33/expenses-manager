<?php require_once "./inc/header.php"; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Login</h1>
        <div class="col-10 col-md-8 col-lg-6">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php require_once "./inc/footer.php"; ?>