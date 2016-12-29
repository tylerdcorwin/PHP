<!DOCTYPE html>

<html>
    <head>

        <meta charset="UTF-8">
        <title>View</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <meta charset="UTF-8">
        <title>Delete Products</title>
    </head>
    <body>
        <?php
        session_start();

        include './KillLogin.php';
        include_once './functions.php';

        $db = dbconnect();

        $product_id = filter_input(INPUT_GET, 'product_id');

        $stmt = $db->prepare("DELETE FROM products where product_id = :product_id");

        $binds = array(
            ":product_id" => $product_id
        );


        $isDeleted = false;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }
        ?>


        <h1> Record <?php echo $product_id; ?>
            <?php if (!$isDeleted): ?> 
                Not
            <?php endif; ?>
            Deleted</h1>
    <tr>
        <td><p> <a class="btn-primary" href="viewproducts.php">View products</a></p></td>
    </tr>



</body>
</html>


