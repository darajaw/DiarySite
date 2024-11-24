<?php
//File Name: create.php
//Code written by: Daraja Williams
//Description: This file enters new journal entries into the database.

//start the session
session_start();

//this method can be used to check if a user is logged in
function confirm_login(){
    if (!isset($_SESSION['valid_user'])) {
        header("Location: login.php");
    }
}