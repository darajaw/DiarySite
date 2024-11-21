<?php

session_start();
function confirm_login(){
    if (!isset($_SESSION['valid_user'])) {
        header("Location: login.php");
    }
}