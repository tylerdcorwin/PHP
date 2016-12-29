<!DOCTYPE html>
<!--
Tyler Corwin
Final Lab
8/25/2016

Signup page
-->
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up!</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
         Optional theme 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

        <script type="text/Javascript">
        </script>
    </head>

    <body>

        <?php session_start(); ?>

        <div id="wrapper"><!--Start of Wrapper div-->
            <header id="header">
                <h1 id="name">  Sign Up! </h1>
            </header><!--Close header-->

            <nav id="nav1">
                <div class="btn-container">
                    <a class="btn2" href="welcome.php">Home</a>
                    <a class="btn2" href="login.php">Login</a>


                </div><!--End div button containter-->
            </nav><!--Close nav element-->

            <section id="left">               
                <div class="home-pic">

                    <?php
                    //access database
                    include './functions.php';
                    //clear validation variables
                    $results = '';
                    $email = filter_input(INPUT_POST, 'email');
                    $password = filter_input(INPUT_POST, 'password');
                    //connect to table and add data
                    if (isPostRequest()) {
                        $db = dbconnect();

                        if (empty($email)) {
                            $errors[] = ' Email Cant be blank entry';
                        }
                        if (empty($password)) {
                            $errors[] = ' Password Cant be blank entry';
                        }
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                            $errors[] = ' Invalid Email';
                        }
                        if ($password < 4) {
                            $errors[] = 'Password cannot be less than 4 characters';
                        }

                        $stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
                        $binds = array(
                            ":email" => $email
                        );
                        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                            $errors[] = ' Email has already been added to the database';
                        }

                        if (count($errors) == 0) {


                            $stmt = $db->prepare("INSERT INTO users SET created = now(), email = :email, password = :password");
                            //declare variables for tables that get data
                            $email = filter_input(INPUT_POST, 'email');
                            $password = filter_input(INPUT_POST, 'password');

                            $binds = array(
                                ":email" => $email,
                                ":password" => sha1($password)
                            );
                            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                                $results = 'User Accepted';
                            }
                            header('Location: login.php');
                        }
                    }
                    //ask about adding the email and password to the database tables
                    //getting an error in the sql "Undefined variable: server"
                    ?>

                    <h1><?php echo $results; ?></h1>



                    <?php if (isset($errors) && is_array($errors)) : ?>
                        <ul>           
                            <?php foreach ($errors as $error): ?>            
                                <li><?php echo $error; ?></li>            
                            <?php endforeach; ?>        
                        </ul>
                    <?php endif; ?>

                    <form method="post" action="#">

                        <div class="login">
                            <input type="text" placeholder="Email" id="email" name="email">  
                            <input type="password" placeholder="Password" id="password" name="password">  
                            <a href="#" class="forgot">forgot password?</a>
                            <input type="submit" value="Sign Up!">
                        </div>
                        <div class="shadow"></div>

                    </form>

                    <h1>&nbsp;&nbsp;Check out all of the greatest deals of the summer! </h1>
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
