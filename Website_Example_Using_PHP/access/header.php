<?php

$logout = filter_input(INPUT_GET, 'logout');

if ($logout == 1) {
    $_SESSION['loggedin'] = false;
    unset($_SESSION['user_id']);
}

if (isset($_SESSION['loggedin']) &&
        $_SESSION['loggedin'] === true) {
    //echo '<a href="?logout=1">Logout</a>';
    //create logout page
}
 