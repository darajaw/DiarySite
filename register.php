<?php

require_once('database.php');
//include "headerEm.php";
$db = db_connect();

//Handle form values sent by reg_page.php (soon to be /php?)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pass'];
    
    check_duplicate($db, $username, $email);// make sure this isnt a duplicate user

    //prepare query string
    $sql = "INSERT INTO users (user_email, username, password) VALUES ('$email', '$username', '$password')";
    $result = mysqli_query( $db, $sql );

    // don't need following line?, no need to show user details by id after they register
    //$id = mysqli_insert_id($db); //the mysqli_insert_id() function returns the id

    header("Location login.php?status=reg"); //will need to change this to login page, once created
}
else {
    header("Location: reg_page.phpstatus=error");
}

function check_duplicate($db, $username, $email){
    
    $users_sql = "SELECT * FROM users"; //query to retrieve list of all users
    $users_row = mysqli_query( $db, $users_sql ); //run query on database
   
    //compare new user to each existing user to check for duplicates
    while ($user = mysqli_fetch_array($users_row)){
        if ( $user['user_email'] == $email ) {
            //email error if email is duplicate
            header("Location: reg_page.php?status=email_error");
            exit();
        }
        elseif ( $user['username'] == $username ) {
            //username error if username is duplicate
            header("Location: reg_page.php?status=user_error");
            exit();
        }
    }
}
