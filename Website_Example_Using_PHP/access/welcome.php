<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome Page</title>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
         Optional theme 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        -->
        <link rel="stylesheet" type="text/css" href="style.css"/>

        <script type="text/Javascript">
        </script>
    </head>

    <body>
        <?php
        session_start();
        ?>

        <div id="wrapper"><!--Start of Wrapper div-->
            <header id="header">
                <h1 id="name"> Welcome To Ty's Snowboard Shack </h1>
            </header><!--Close header-->

            <nav id="nav1">
                <div class="btn-container">
                    <a class="btn1" href="welcome.php">Home</a>
                    <a class="btn1" href="../shoppingcart/shop.php">Shop</a>
                    <a class="btn1" href="login.php">Login</a>
                    <a class="btn1" href="signup.php">Sign Up!</a>
                    <a class="btn1" href="admin.php">Admin</a>
                </div><!--End div button containter-->
            </nav><!--Close nav element-->
            <section id="left">
                <div class="home-pic"><img src="images/home.jpeg" alt="home"/>
                </div>

                <h1>Where the pro's shop! </h1>
                <br><br>
                Sign up today to see what is in stock!                            
            </section>
            <!--close left section tag-->

            <!--Right section-->
            <aside id="right">
                <header id="sidebar"><h3 class="feature-title">Features</h3>
                </header><!--close the right header-->
                <a href="login.php"><img class="side-thumb" src="images/slide01.jpg" alt=""/></a>
                <a href="login.php"><img class="side-thumb" src="images/slide02.jpg" alt=""/></a>
                <a href="login.php"><img class="side-thumb" src="images/slide03.jpg" alt=""/></a>
            </aside><!--closes rigth section on da side-->
            <!--Foooter-->
            <footer id="footer">
                <p>&copy;Copyright 2016, Ty's Snowboard Shack.</p>
            </footer>

        </div><!--End of Wrapper-->



    </body>
</html>
