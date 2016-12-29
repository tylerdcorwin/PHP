<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Category</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


    </head>
    <body>
        <?php
        session_start();

        include './KillLogin.php';
        include_once './functions.php';

        $db = dbconnect();

        $result = '';

        $category = '';

        if (isPostRequest()) {
            $category_id = filter_input(INPUT_POST, 'category_id');
            $category = filter_input(INPUT_POST, 'category');
            //calling database and updating category
            $stmt = $db->prepare("UPDATE categories SET category = :category WHERE category_id = :category_id");
            //setting category id to match the database
            $binds = array(
                ":category_id" => $category_id,
                ":category" => $category
            );

            //error message
            $message = 'Update Failed';
            //validation
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $message = 'Category updated';
            }
        } else {
            //pulling from the url
            $category_id = filter_input(INPUT_GET, 'category_id');

            if (!isset($category_id)) {
                die('Record not found');
            }

            $stmt = $db->prepare("SELECT * FROM categories where category_id = :category_id");
            $binds = array(
                ":category_id" => $category_id
            );

            $results = array();

            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);

                $category = $results['category'];
            } else {
                die('ID not found');
            }
        }
        ?>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <h2>Update Category</h2>

        <form method="post" action="#">            
            Category Name: <input type="text" value="<?php echo $category; ?>" name="category" />
            <br />

            <input type="hidden" value="<?php echo $category_id; ?>" name="category_id" /> 
            <input type="submit" value="Update Category" class="btn btn-success" />
        </form>


        <p> <a href="viewcategory.php">View Categories</a>&emsp;&emsp;
            <a href="addcategory.php">Create Categories</a>&emsp;&emsp;
            <a href="admin.php">Admin Homepage</a></p>


    </body>
</html>
