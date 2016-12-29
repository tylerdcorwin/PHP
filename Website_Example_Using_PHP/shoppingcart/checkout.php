<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="../access/style.css"/>

        <script type="text/Javascript">
        </script>

    </head>
    <body>
        <?php
        include '../access/functions.php';
        session_start();

        /* php processing variables */
        $action = filter_input(INPUT_POST, 'action');

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
                $cart = getCart();
                $total = getCartTotal();

                include './cart-items.html.php';
                include './clear-cart.html.php';
                ?>


            </section>
            <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href="shop.php">Continue Shopping</a></p>


    </body>
</html>
