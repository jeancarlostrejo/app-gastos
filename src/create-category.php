<?php 
use Ferre\Gastos\models\Category;


if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = $_POST["name"];
    
    if(!Category::exists($name)) {
        $category = new Category($name);
        $category->save();
    }
}
$categories = Category::getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>
<body>
    <?php require "src/resources/navbar.php" ?>
    <div class="container">
        <h1>Create Category</h1>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Name of category...">
            <input type="submit" value="Create Category">
        </form>

        <div class="categories">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <div class="category">
                        <?= $category->getName() ?>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</body>
</html>