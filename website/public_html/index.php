<?php require_once '../inc/header.php';

$actualMonth = date('F');
// $monthDB = $helperClass->getMonthDB();
$wallet = $helperClass->getActualWallet();

$monthExpenses = $expenseController->getExpensesByMonth(date('m'));
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 align="center"><?= $actualMonth ?></h1>
            <h1>Portefeuille : <?= $wallet->amount ?> €</h1>           
        </div>
    </div>
</div>
<?php require_once '../inc/footer.php' ?>