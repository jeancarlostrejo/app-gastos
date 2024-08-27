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
</head>
<body>
    <h1>Home</h1>

    <div>Total $: <?= $total ?></div>

    <?php if(!empty($expenses)): ?>
        <?php foreach($expenses as $expense) : ?>
                <div class="expenses"> 
                    <div><?= $xpense->getTitle()?></div>
                    <div><?= $xpense->getCategory()->getName()?></div>
                    <div><?= $xpense->getExpense()?></div>
                </div>

        <?php endforeach ?> 
    <?php endif?>
</body>
</html>
