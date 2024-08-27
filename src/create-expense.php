<?php

use Ferre\Gastos\models\Category;
use Ferre\Gastos\models\Expense;

if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["category_id"]) && !empty($_POST["category_id"]) && isset($_POST["expense"]) && !empty($_POST["expense"])) {
    $title = $_POST["title"];
    $categoryId = $_POST["category_id"];
    $expense = $_POST["expense"];

    $expense = new Expense($title, $categoryId, $expense);
    $expense->save();
}
$categories = Category::getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Expense</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>
<body>
    <div class="container">
        <h1>Create Expense</h1>
        <form action="" method="POST">
            <input type="text" name="title" placeholder="Name of expense...">
            <input type="number" name="expense" placeholder="30.0">
            <select name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?=$category->getId();?>"><?=$category->getName();?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" value="Create expense">
        </form>
    </div>
</body>
</html>