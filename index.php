<?php
require_once("session.php");
confirm_login();
?>

<!DOCTYPE html>
<html>
<!--File Name: index.php-->
<!--Code written by: Stephanie Prystupa-Maul-->
<!--Description: This is the home page for the website.-->

<head>
    <title>Smart Diary Home</title>
</head>

<body id="index-body" class="index-container">

    <header>
        <h1 id="title">Smart Diary</h1>
        <nav id="logout-nav">
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="index-container">
            <!-- <div id="greeting-div"> -->
                <h2><?php echo '<p>Welcome ' . $_SESSION['valid_user'] . '!</p>'; ?></h2>
                <h3>What would you like to do?</h3>
            <!-- </div> -->

        <nav id="site-nav" class="index-container">
            <div class="site-nav-section">
                <a href="new_entry.php">New Entry</a>  
            </div>  
            <div class="site-nav-section">
                <a href="search.php">Search</a>
            </div>
            <div class="site-nav-section">
                <a href="view.php">View Entries</a>   
            </div> 
        </nav>

        <!--
        <nav id="logout-nav">
            <a href="logout.php">Logout</a>
        </nav>
        -->

    </div>

    <?php include("footer.php"); ?>
</body>

</html>