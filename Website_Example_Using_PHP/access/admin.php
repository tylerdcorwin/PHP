<!DOCTYPE html>
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
        <?php session_start(); ?>
        <?php
        include_once './header.php';
        include_once './functions.php';
        if (!isLoggedIn()) :
            ?> 
            <div id="wrapper"><!--Start of Wrapper div-->
                <header id="header">
                    <h1 id="name"> Welcome To Ty's Snowboard Shack </h1>
                </header><!--Close header-->

                <nav id="nav1">
                    <div class="btn-container">
                        <a class="btn2" href="welcome.php">Home</a>                        
                        <a class="btn2" href="login.php">Login!</a>

                    </div><!--End div button containter-->


                </nav><!--Close nav element-->
                <section id="left">
                    <h2><strong>  Logged Out! </strong></h2>
                    <div class="home-pic"><img src="images/home.jpeg" alt="home"/>
                    </div>
                </section>
                <!--close left section tag-->

                <!--Right section-->
                <aside id="right">
                    <header id="sidebar"><h3 class="feature-title">Features</h3>
                    </header><!--close the right header-->
                    <a href="#"><img class="side-thumb" src="images/slide01.jpg" alt=""/></a>
                    <a href="#"><img class="side-thumb" src="images/slide02.jpg" alt=""/></a>
                    <a href="#"><img class="side-thumb" src="images/slide03.jpg" alt=""/></a>
                </aside><!--closes right section on da side-->
                <!--Footer-->
                <footer id="footer">
                    <p>&copy;Copyright 2016, Ty's Snowboard Shack.</p>
                </footer>

            </div><!--End of Wrapper-->
            <?php
            die('');
        endif;
        ?>


        <div id="wrapper"><!--Start of Wrapper div-->
            <header id="header">
                <h1 id="name"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Administrative Tools </h1>
            </header><!--Close header-->

            <nav id="nav1">
                <div class="btn-container">
                    <a class="btn2" href="welcome.php">Home</a>
                    <a class="btn2" href="?logout=1">Logout</a>

                </div><!--End div button containter-->


            </nav><!--Close nav element-->
            <section id="center">
                <div class="home-pic"><a href="addproducts.php"><img src="images/AddProducts.jpg" alt="home"/></a></div>
                <div class="home-pic"><a href="addcategory.php"><img src="images/AddCategories.jpg" alt="home"/></a></div>
                <div class="home-pic"><a href="viewproducts.php"><img src="images/ViewProducts.jpg" alt="home"/></a></div>
                <div class="home-pic"><a href="viewcategory.php"><img src="images/ViewCategories.jpg" alt="home"/></a></div>

            </section>

            <!--Footer-->
            <footer id="footer">
                <p>&copy;Copyright 2016, Ty's Snowboard Shack.</p>
            </footer>

        </div><!--End of Wrapper-->



    </body>
</html>

