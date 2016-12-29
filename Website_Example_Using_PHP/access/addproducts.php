<!DOCTYPE html>
<html>
    <?php
    session_start();

    include './KillLogin.php';
    ?>
    <head>

        <meta charset="UTF-8">
        <title>Add Products</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <h1>Add new product</h1>
        <div id="nav">
            <br>
            <a class="btn btn-primary" href="admin.php">Back To Admin</a> 
            <br>
        </div>
        <?php
        include_once './functions.php';
        $db = dbconnect();

        /* Call in built in functions */
        $results = '';
        /* Dropdown */
        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category DESC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = '';
        /* Call in the Database */
        $categoryid = filter_input(INPUT_POST, 'category_id');
        $image = filter_input(INPUT_POST, 'image');
        $price = filter_input(INPUT_POST, 'price');
        $product = filter_input(INPUT_POST, 'product');

        if (isPostRequest()) {
            //$image=  uploadImage('upfile');
            /* Call in the mySQL statement */
            try {

                if (count($_FILES) > 0) {

                    $image = uploadImage('upfile');
                }
            } catch (RuntimeException $e) {

                echo $e->getMessage();
            }
            $stmt = $db->prepare("INSERT INTO products SET category_id = :category_id, image = :image, price = :price, product = :product");
            /* Create input data categories */


            /* Convert to an array */
            $binds = array(
                ":category_id" => $categoryid,
                ":image" => $image,
                ":price" => $price,
                ":product" => $product
            );
            /* Check for Validation */
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = 'Data Added';
            }
        }
        ?>


        <h1><?php echo $results; ?></h1>
        <?php
        /* Create Form */
        ?>
        <h5> <strong>Category</strong> </h5>
        <form enctype="multipart/form-data" action="#" method="POST">            
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
            <div class="form-group">
                <label for="image">Image</label>
                <input name="upfile" type="file" value="" />
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" value="" name="price" class="form-control" id="price" placeholder="$0.00">
            </div>

            <div class="form-group">
                <label for="product">Product</label>
                <input type="text" value="" name="product" class="form-control" id="product" placeholder="Product">
            </div>   


            <input type="submit" value="Submit" class="btn btn-primary" />

        </form>
        <!-- Buttons for Navigation-->
        <div id="nav">
            <br>
            <a class="btn btn-warning" href="viewproducts.php">View Product</a> 
            <a class="btn btn-warning" href="addcategory.php">Add Category</a> 
            <a class="btn btn-warning" href="viewcategory.php">View Category</a> 
        </div>
    </body>
</html>
