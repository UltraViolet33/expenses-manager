<?php require_once '../../inc/header.php';
$categories = $categoryController->getAll();
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h1 class="text-center">All categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <th scope="row"><?= $category->id_category ?></th>
                            <td><?= $category->name ?></td>
                            <td><a href="editCategory.php?id=<?= $category->id_category ?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../../inc/footer.php';
