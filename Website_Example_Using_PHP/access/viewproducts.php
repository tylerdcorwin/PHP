<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Read</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    </head>

    <body>

        <h1>Product View</h1>
        <div id="nav">
            <br>
            <a class="btn btn-primary" href="admin.php">Back To Admin</a> 
            <br>
        </div>
        <?php
        /* Call in Built in options */
        session_start();

        include './KillLogin.php';
        include_once './functions.php';

        $db = dbconnect();

        /* Dropdown */
        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category DESC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = '';

        if (isPostRequest()) {

            $stmt = $db->prepare("SELECT * FROM products WHERE category_id = :category_id");

            $category_id = filter_input(INPUT_POST, 'category_id');

            $binds = array(
                ":category_id" => $category_id
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $error = 'No Products under this category';
            }
        }
        ?>

        <?php if (isset($error)): ?>        
            <h1><?php echo $error; ?></h1>
        <?php endif; ?>

        <h5> <strong>Select Category</strong> </h5>
        <form action="#" method="POST">            
            <select class="form-control" name="category_id">

                <?php foreach ($categories as $row): ?>
                    <option 
                        value="<?php echo $row['category_id']; ?>"
                        <?php if (intval($category_id) === $row['category_id']) : ?>
                            selected="selected"
                        <?php endif; ?>
                        >
                        <!--display the category list-->
                        <?php echo $row['category']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" value="View Products"/>
        </form>
        <?php if (isset($results)): ?>


            <!--show number of products found-->
            <h5>Products Found <?php echo count($results); ?> </h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name: </th>
                        <th>Price: </th>
                        <th>Image: </th>

                    </tr>
                </thead>

                <!--  loop through results to get back an array with values-->

                <?php foreach ($results as $row): ?> 
                    <tr>
                        <td><?php echo $row['product']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td> <img src="images/<?php echo $row['image']; ?>" width="100px" /></td>
                        <td><a class="btn btn-success" href="updateproducts.php?product_id=<?php echo $row['product_id']; ?>">Update</a></td>            
                        <td><a class="btn btn-danger" href="deleteproducts.php?product_id=<?php echo $row['product_id']; ?>">Delete</a></td>            
                    </tr>

                <?php endforeach; ?>

            </table>
        <?php endif; ?>
        <div id="nav">
            <br>
            <a class="btn btn-warning" href="addproducts.php">Add Product</a> 
            <a class="btn btn-warning" href="addcategory.php">Add Category</a> 
            <a class="btn btn-warning" href="viewcategory.php">View Category</a> 
        </div>

    </body>
</html>
