<?php

require_once('database.php');
//include "headerEm.php";
$db = db_connect();

//Handle form values sent by reg_page.html (soon to be /php?)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //prepare query string
    $sql = "INSERT INTO 'users' ('user_email', 'username', 'password') VALUES ('$email', '$username', '$password')";
    $result = mysqli_query( $db, $sql );

    // don't need following line?, no need to show user details by id after they register
    //$id = mysqli_insert_id($db); //the mysqli_insert_id() function returns the id

    header("Location reg_page.html"); //will need to change this to login page, once created
}
else {
    header("Location: reg_page.html");
}