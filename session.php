<?php
//File Name: create.php
//Code written by: Daraja Williams
//Description: This file enters new journal entries into the database.

//start the session
session_start();

//this function can be used to check if a user is logged in
function confirm_login(){
    if (!isset($_SESSION['valid_user'])) {
        header("Location: login.php");
    }
}

//If the logout ID was used, log the user out and send them to the login page
if (isset($_GET['id']) && $_GET['id'] == 'logout') {

    unset($_SESSION['valid_user']); //delete session variable
    session_unset();

    session_destroy(); //kill the session

    header('Location: login.php?id=out'); //redirect to login page
}