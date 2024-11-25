<?php
    //File Name: search.php
    //Code written by: Daraja Williams
    //Edited by: Stephanie Prystupa-Maule
    //Description: This page allows users to search for previous entries in the database.

    require_once('session.php');
    require_once("database.php");
    $db = db_connect();

// Handle form values sent by search.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // get the user id from the session

    // access the form data
    $start_date = $_POST['start_date']; 
    $end_date = $_POST['end_date'];
    $mood = $_POST['mood'];

    //search with no dates
    $entry_search = "SELECT entry_id,date,title FROM entries WHERE user_id = '$user_id'";

    //search with a start date only
    if (!empty($start_date) && empty($end_date)){
        $entry_search .= " AND date >= '$start_date'";
    }

    //search with a end date only
    elseif (empty($start_date) && !empty($end_date)){
        $entry_search .= " AND date <= '$end_date'";
    }

    //search with a start and end date
    elseif (!empty($start_date) && !empty($end_date)){
        $entry_search .= " AND date BETWEEN '$start_date' AND '$end_date'";
    }

    //check if a mood was set to filter by
    if (!($mood == "none")) {

        $mood_sql = "SELECT mood_id FROM moods WHERE mood = \"$mood\""; //query to get the mood id
        $mood_row = mysqli_query($db, $mood_sql); //execute the query
        $mood_fetch = mysqli_fetch_assoc($mood_row); //fetch the resulting row
        $mood_id = (int)$mood_fetch['mood_id']; //get the mood id value

        $entry_search .= " AND entry_mood = '$mood_id'"; //add the mood id to the search query
    }

    $results = mysqli_query($db, $entry_search); //execute the search query
    $result_fetch = mysqli_fetch_all($results); //fetch all the results
} 
?>

<!DOCTYPE html>
<html lang="en"></html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">        
    <meta name="description" content="Allows users to search for past entries">
    <link rel="stylesheet" type="text/css" href="assets/style_working.css">
    <title>Search Entries Page</title>
</head>

<body>

    <div class="banner_container"> 
        <!-- insert the header and navigation bar -->
        <?php include("header.php");?>
        <?php include("nav_bar.php");?>
    </div>

    <div #id="search_container" class="page_container">


        <form action="search.php" method="POST" id="search_form" class="page_form">
            
            <!-- Subheading specific to this page -->
            <h2 class="page_heading">Search Entries</h2>

            <div id="search_bar">
                <!-- Optional Search Fields -->
                <div class="field_wrapper">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date"> 
                </div>
                      
                <div class="field_wrapper">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date"> 
                </div>
                        
                <div class="field_wrapper">
                    <label for="mood">Filter By Mood:</label>
                    <select  name="mood" id="mood">
                        <option value="none">None</option>
                        <option value="amazing">Amazing</option>
                        <option value="good">Good</option>
                        <option value="neutral">Neutral</option>
                        <option value="bad">Bad</option>
                        <option value="terrible">Terrible</option>
                    </select>
                </div>

                <div id="search_button_wrapper" class="button_wrapper">
                    <button type="submit">Search</button>
                </div>
            </div>

        </form>

        <!-- Display the search results -->
        <div id="results_container"> 

            <?php if (isset($start_date)){ ?>

                <!-- Adjusted Heading for Different Search Criteria -->
                <h3 id="results_heading" class="page_subheading">
                    <?php 
                        //results with no set dates
                        if (empty($start_date) && empty($end_date)){  
                            echo "All Entries";
                        }
                        //results with a start date only
                        elseif (!empty($start_date) && empty($end_date)){  
                            echo "Entries since: $start_date";
                        }
                        //results with a end date only
                        elseif (empty($start_date) && !empty($end_date)){
                            echo "Entries before: $end_date";
                        }
                        //results with a start and end date
                        elseif (!empty($start_date) && empty($end_date)){
                            echo "Entries between: $start_date and $end_date";
                        }
                        //results with a specific mood
                        if (!($mood == "none")) {
                            echo " with mood: ", ucfirst($mood);
                        }
                    ?>
                </h3>
                
                <!-- Returned Records -->
                <fieldset id="results"> 
                    <?php  
                        if(empty($result_fetch)){
                            echo "<p>No matching entries found</p>";
                        }
                        else{                    
                            foreach ($result_fetch as $row) {
                            $id = $row[0];
                            $date = $row[1];
                            $title = $row[2];
                            
                            //Display each result as a link to the entry edit page
                            echo "<p><a href=\"edit_entry.php?id=$id\">$date - $title</a></p>";
                            }
                        } 
                    ?>
                </fieldset>
                
            <!-- End of if statement checking for valid session -->
            <?php } ?>
        </div>

    </div>

    <!-- Insert Footer -->
    <?php include("footer.php"); ?>

</body>
</html>