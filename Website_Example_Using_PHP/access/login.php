<!DOCTYPE html>
<!--
Tyler Corwin
Final Lab
8/25/2016

Login page
-->
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login!</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
         Optional theme 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

        <script type="text/Javascript">
        </script>
    </head>

    <body>

        <?php session_start(); ?>
        <?php include_once './header.php'; ?>

        <div id="wrapper"><!--Start of Wrapper div-->
            <header id="header">
                <h1 id="name">  Login to see our unreal deals! </h1>
            </header><!--Close header-->

            <nav id="nav1">
                <div class="btn-container">
                    <a class="btn1" href="welcome.php">Home</a>
                    <a class="btn1" href="login.php">Login</a>
                    <a class="btn1" href="signup.php">Sign Up!</a>

                </div><!--End div button containter-->
            </nav><!--Close nav element-->

            <section id="left">

                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    You are logged in
                <?php else: ?>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    Please login to begin shopping
                <?php endif; ?>

                <div class="home-pic">

                    <?php
                    //access database
                    include './functions.php';
                    //clear validation variables
                    $results = '';
                    $db = dbconnect();
                    //connect to table and add data
                    if (isPostRequest()) {
                        // $db = dbconnect();
                        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                        //declare variables for tables that get data
                        $email = filter_input(INPUT_POST, 'email');
                        $password = sha1(filter_input(INPUT_POST, 'password'));

                        $binds = array(
                            ":email" => $email,
                            ":password" => $password
                        );

                        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {

                            $results = 'User is logged in';
                            $_SESSION['loggedin'] = true;

                            $_SESSION['user_id'] = $user['user_id'];
                            header('Location: admin.php');
                        } else {
                            echo 'incorrect password or username';
                        }
                    }
                    ?>

                    <h1><?php echo $results; ?></h1>

                    <div class="login">
                        <form action="#" method="post">
                            <input type="text" placeholder="Email" id="email" name="email" value="">  
                            <input type="password" placeholder="Password" id="password" name="password" value="">  
                            <a href="#" class="forgot">forgot password?</a>
                            <input type="submit" value="Login" >
                        </form>
                    </div>
                    <div class="shadow"></div>



                    <h1>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        Where the pro's shop! </h1>
                    <br>
                    &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
                    Sign up today to see what is in stock!  
                    <a href="login.php"><img class="side-thumb" src="images/slide04.jpg" alt=""/></a>
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

</html>
