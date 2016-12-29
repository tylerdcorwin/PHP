<?php

//Connect to database
function dbconnect() {
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPClassSummer2016',
        'DB_USER' => 'root',
        'DB_PASSWORD' => ''
    );

    try {
        /* Create a Database connection and 
         * save it into the variable */
        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
        /* If the connection fails we will close the 
         * connection by setting the variable to null */
        $db = null;
    }

    return $db;
}

//post to url
function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');
}

//login validation
function isLoggedIn() {

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false
    ) {
        return false;
    }
    return true;
}

//call record from database
function getRecord($id) {

    $db = dbconnect();

    $stmt = $db->prepare("SELECT * FROM products WHERE product_id = :product_id");

    $binds = array(
        ":product_id" => $id);
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return $results;
}

//update record in database
function updateRecord($categoryid, $image, $price, $product) {

    $db = getDatabase();

    $stmt = $db->prepare("UPDATE products SET category_id = :catagory_id, image = :image, price = :price, product = :product WHERE product_id = :product_id");

    $binds = array(
        ":category_id" => $categoryid,
        ":image" => $image,
        ":price" => $price,
        ":product" => $product,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        //    var_dump($db->errorInfo());
        return true;
    } else {
        //  var_dump($db->errorInfo());
        return false;
    }
}

//upload images and save to specified file
function uploadImage($fieldName) {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (!isset($_FILES[$fieldName]['error']) || is_array($_FILES[$fieldName]['error'])) {
        throw new RuntimeException('Invalid parameters.');
    }
    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES[$fieldName]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
    // You should also check filesize here. 
    if ($_FILES[$fieldName]['size'] > 1000000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $validExts = array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    );
    $ext = array_search($finfo->file($_FILES[$fieldName]['tmp_name']), $validExts, true);
    if (false === $ext) {
        throw new RuntimeException('Invalid file format.');
    }
    $fileName = sha1_file($_FILES[$fieldName]['tmp_name']);
    $location = sprintf('./images/%s.%s', $fileName, $ext);
    if (!is_dir('./images')) {
        mkdir('./images');
    }
    if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $location)) {
        throw new RuntimeException('Failed to move uploaded file.');
    }
    /* return the file name uploaded */
    return $fileName . '.' . $ext;
}

//pull products from database to populate table
function getItems() {    // get all products
    //include_once '../functions/dbconnect.php';
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM products");
    $ProductResults = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $ProductResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } return $ProductResults;
}

//upload all categories on index
function getCategories() {      // get all categories
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM categories");
    $CategoryResults = array(
    );
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $CategoryResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } return $CategoryResults;
}

//uploads products by category id to populate table
function getItemsByCategory($id) {
    $items = getItems();
    //$category_id = filter_input(INPUT_POST, 'category_id');
    $cart = [];
    foreach ($items as $product) {
        if ($product['category_id'] == $id) {     //'category' is suppose to be 'category_id'
            $cart[] = $product;
        }
    }
    return $cart;
}

//clear items in cart
function emptyCart() {
    unset($_SESSION['cart']);
}

//start a new cart
function startCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

//call a cart for sessions
function getCart() {
    return $_SESSION['cart'];
}

//count the number of products in the cart
function cartCount() {
    return count(getCart());
}

//add products to cart
function addToCart($id) {
    $items = getItems();

    foreach ($items as $product) {
        if ($product['product_id'] == $id) {
            $_SESSION['cart'][] = $product;
            break;
        }
    }
}

//process total of items in cart based of prices
function getCartTotal() {
    $items = getCart();
    $total = 0;
    foreach ($items as $product) {
        $total += $product['price'];
    }
    return $total;
}
