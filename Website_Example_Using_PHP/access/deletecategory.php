<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();

        include './KillLogin.php';
        include_once './functions.php';

        $db = dbconnect();

        $category_id = filter_input(INPUT_GET, 'category_id');

        $stmt = $db->prepare("DELETE FROM categories where category_id = :category_id");

        $binds = array(
            ":category_id" => $category_id
        );


        $isDeleted = false;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }
        ?>


        <h1> Record <?php echo $category_id; ?>
            <?php if (!$isDeleted): ?> 
                Not
            <?php endif; ?>
            Deleted</h1>

        <p> <a href="viewcategory.php">View Categories</a></p>



    </body>
</html>


