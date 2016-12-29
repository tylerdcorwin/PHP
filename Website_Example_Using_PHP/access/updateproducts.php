<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>
        <?php
        session_start();

        include './KillLogin.php';

        include_once './functions.php';


        $db = dbconnect();


        $result = '';
        $product = '';
        $price = '';
        $image = '';

        // get catagories
        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category DESC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = '';


        if (isPostRequest()) {
            $product_id = filter_input(INPUT_POST, 'product_id');
            $product = filter_input(INPUT_POST, 'product');
            $price = filter_input(INPUT_POST, 'price');
            $image = filter_input(INPUT_POST, 'image');
            $category_id = filter_input(INPUT_POST, 'category_id');


            $stmt = $db->prepare("UPDATE products SET product = :product, category_id = :category_id, price = :price, image = :image  WHERE product_id = :product_id");
            //try catch for image
            try {

                if (count($_FILES) > 0) {

                    $image = uploadImage('upfile');
                }
            } catch (RuntimeException $e) {

                //echo $e->getMessage();
            }

            $binds = array
                (
                ":category_id" => $category_id,
                ":product_id" => $product_id,
                ":product" => $product,
                ":price" => $price,
                ":image" => $image,
            );

            $message = 'Update failed';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $message = 'Update Complete';
            }
        } else {
            $product_id = filter_input(INPUT_GET, 'product_id');

            if (!isset($product_id)) {
                die('Record not found');
            }

            //product _id
            $stmt = $db->prepare("SELECT * FROM products where product_id = :product_id");
            $binds = array
                (
                ":product_id" => $product_id
            );
            $results = array();
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                $product = $results['product'];
                $price = $results['price'];
                $image = $results['image'];
            } else {
                die('ID not found');
            }
        }
        ?>

        <p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>


        <h1>Update Product Inventory</h1>
        <br />
        <br />
        <form method="post" action="#" enctype="multipart/form-data">

            <td><strong>Current Category</strong></td>
            <select class="form-control" name="category_id">
                <?php foreach ($categories as $row): ?>
                    <option 
                        value="<?php echo $row['category_id']; ?>"
                        <?php if (intval($category_id) === $row['category_id']) : ?>
                            selected="selected"
                        <?php endif; ?>
                        >
                            <?php echo $row['category']; ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <td><strong>Product: </strong><br> <input type="text" value="<?php echo $product ?>" name="product" size="40"/></td>
            <br />
            <td><strong>Price: </strong><br> <input type="text" value="<?php echo $price ?>" name="price" size="40"/></td>
            <br />
            <td><strong>Current Image: </strong><br><img src="images/<?php echo $image; ?>" width="600px" /></td>
            <br>
            <br> <input class="btn-warning" type="file" value="" name="upfile" size="485"/>         

            <br>

            <!-- need hidden for image   product id -->
            <input type="hidden" value="<?php echo $product_id; ?>" name="product_id" /> 
            <input type="hidden" value="<?php echo $image; ?>" name="image" /> 
            <input class="btn btn-success"type="submit" value="Update" />
        </form>

        <p> <a class="btn btn-primary" href="viewproducts.php">View products page</a></p>

    </body>
</html>