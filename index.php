<?php
require_once("session.php");
confirm_login();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Smart Diary Home</title>
</head>

<body>
    <h2><?php echo '<p>Welcome ' . $_SESSION['valid_user'] . '</p>'; ?></h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="new_entry.php">New Entry</a>    
        <a href="search.php">Search</a>
        <a href="view.php">View Entries</a>    
        <a href="logout.php">Logout</a>
    </nav>
    <?php include("footer.php"); ?>
</body>

</html>