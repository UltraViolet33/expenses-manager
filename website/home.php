<?php require_once './inc/header.php';

if (!Session::get('userId')) {
    header("Location: login.php");
}

?>

<h1>Bienvenue <?= Session::get('username') ?> !</h1>
<?php require_once './inc/footer.php'; ?>