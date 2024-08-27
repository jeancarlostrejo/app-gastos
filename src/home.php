<?php

use Ferre\Gastos\models\Expense;

$expenses = Expense::getAll();

$total = Expense::getTotal($expenses);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>
<body>
    <div class="container">
        <h1>Home</h1>
        <div>Total $: <?=$total;?></div>
        <?php if (!empty($expenses)): ?>
            <div class="expenses">
                <?php foreach ($expenses as $expense): ?>
                <div class="expense">
                    <div><?=$expense->getTitle();?></div>
                    <div><?=$expense->getCategory()->getName();?></div>
                    <div><?=$expense->getExpense();?></div>
                </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
</body>
</html>