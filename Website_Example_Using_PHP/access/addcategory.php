<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <title>Create</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <h1>Enter New Category</h1>
        <div id="nav">
            <br>
            <a class="btn btn-primary" href="admin.php">Back To Admin</a> 
            <br>
        </div>

        <?php
        session_start();

        include './KillLogin.php';
        include_once './functions.php';
        include './header.php';
        /* Call in built in functions */
        $results = '';
        /* Call in the Database */
        if (isPostRequest()) {
            $db = dbconnect();
            /* Call in the mySQL statement */
            $stmt = $db->prepare("INSERT INTO categories SET category = :category");
            /* Create input data categories */
            $category = filter_input(INPUT_POST, 'category');

            /* Convert to an array */
            $binds = array(
                ":category" => $category
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

        <form method="post" action="#">
            <div class="form-group">
                <label for="category">Category Name</label>
                <input type="text" value="" name="category" class="form-control" id="category" placeholder="Category">
            </div>


            <input type="submit" value="Submit" class="btn btn-primary" />

        </form>
        <!-- Buttons for Navigation-->
        <div id="nav">
            <a class="btn btn-warning" href="addproducts.php">Add Product</a> 
            <a class="btn btn-warning" href="viewproducts.php">View Product</a> 
            <a class="btn btn-warning" href="viewcategory.php">View Categories</a> 
        </div>
    </body>
</html>
