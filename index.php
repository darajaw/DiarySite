<!DOCTYPE html>
<html>

<!--File Name: index.php-->
<!--Code written by: Stephanie Prystupa-Maule-->
<!--Edited by: Daraja Williams -->
<!--Description: Home/landing page for diary website.-->

<?php
require_once("session.php");
confirm_login();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Stephanie Prystupa-Maule">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <title>Smart Diary Home</title>
</head>

<body>
    
    <!-- Homepage banner only contains header (Title), as nav appears in main page contents -->
    <div id="index_banner_container" class="banner_container"> 
        <?php include("header.php");?>

        <div id="logout_nav_container" class="account_nav_container">
            <nav id="logout_nav" class="account_nav">
                <a href="session.php?id=logout">Logout</a>
            </nav>
        </div>
    </div>

    <div id="index_page_cont" class="page_container"> 

        <h2 class="page_heading"><?php echo '<p>Welcome ' . $_SESSION['valid_user'] . '!</p>'; ?></h2>
        <h3 class="page_subheading">What would you like to do?</h3>

        <!-- The internal links to the site's other pages -->
        <nav id="site_nav">
            <div class="site_link_wrapper">
                <a href="new_entry.php" >New Entry</a>  
            </div>  
            <div class="site_link_wrapper">
                <a href="search.php">Search Diary</a>
            </div>
        </nav>

    </div>

    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>
</html>