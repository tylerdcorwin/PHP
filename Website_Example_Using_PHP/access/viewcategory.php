<!DOCTYPE html>
<!--
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    </head>
    <h1>Current data</h1>
    <div id="nav">
        <br>
        <a class="btn btn-primary" href="admin.php">Back To Admin</a> 
        <br>
    </div>
    <h2> 

    </h2>
    <body>
        <?php
        // call in the include statements for built in functions
        session_start();

        include './KillLogin.php';
        include_once './functions.php';
        //Open the database
        $db = dbconnect();
        //Get the prepare ready by calling the information from the mySQL server
        $stmt = $db->prepare("SELECT * FROM categories");
        //Convert to an array        
        $results = array();
        //Fetch the data
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <!--Display Name for page header-->
                    <th>Company Name:</th>
                </tr>
            </thead>
            <!--For statement returning results from selected row-->
            <?php foreach ($results as $row): ?>
                <tr>
                    <!--Display all called results-->
                    <td><?php echo $row['category']; ?></td>
                    <!--Create Button navigation-->                    
                    <td><a class="btn btn-success" href="updatecategory.php?category_id=<?php echo $row['category_id']; ?>">Update</a></td>
                    <td><a class="btn btn-primary" href="deletecategory.php?category_id=<?php echo $row['category_id']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div id="nav">
            <br>
            <a class="btn btn-warning" href="viewproducts.php">View Product</a> 
            <a class="btn btn-warning" href="addproducts.php">Add Product</a> 
            <a class="btn btn-warning" href="addcategory.php">Add Category</a> 

        </div>

    </body>
</html>
