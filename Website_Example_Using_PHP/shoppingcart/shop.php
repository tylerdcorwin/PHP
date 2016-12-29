<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="../access/style.css"/>

        <script type="text/Javascript">
        </script>
    </head>

</head>
<body>
    <?php
    //include_once './header.php';
    include_once '../access/functions.php';
    session_start();
    //Processing
    $action = filter_input(INPUT_POST, 'action');
    $cartID = filter_input(INPUT_POST, 'product_id');
    $catID = filter_input(INPUT_GET, 'category_id');
    //populate with products from database
    if ($action === 'Buy') {
        addToCart($cartID);
    }

    if ($action === 'Empty cart') {
        emptyCart();
    }
    ?>
    <div id="wrapper"><!--Start of Wrapper div-->
        <header id="header">
            <h1 id="name"> Today's Hot Items! </h1>
        </header><!--Close header-->

        <nav id="nav1">
            <div class="btn-container">
                <a class="btn1" href="../access/welcome.php">Home</a>
                <a class="btn1" href="../shoppingcart/shop.php">Shop</a>
                <a class="btn1" href="../access/login.php">Login</a>
                <a class="btn1" href="../access/signup.php">Sign Up!</a>
                <a class="btn1" href="../access/admin.php">Admin</a>
            </div><!--End div button containter-->
        </nav><!--Close nav element-->        

        <section id="center">

<?php
/* View variables */
startCart();
$items = getItems();    // gets all products     $items is just a variable 
$cartCount = cartCount();   //gets count of items
$allCategories = getCategories();  // gets all categories    $allCategories is just a variable


if (!is_null($catID)) {    // if category_id is not all  then  get products by category_id
    $items = getItemsByCategory($catID);
}


include './categories.html.php';  //category template to list all categories
include './cart-count.html.php';
include './clear-cart.html.php';
include './catalog.html.php';
?>        

        </section>
        <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="checkout.php">CheckOut</a></p>

</body>
</html>
