<!-- 
 TODO:

-form's variables should be renamed to "start_date" style for consistency, 
 but then changes will need to match that elsewhere     
 
-review results fieldset
    -is it still necessary to have the if statement to check if user is in valid session,
     since you have require_once('session.php); at the top of the page?

-->

<!--File Name: search.php-->
<!--Code written by: Daraja Williams-->
<!--Edited by: Stephanie Prystupa-Maule -->
<!--Description: This page allows users to filter and search their past entries -->

<!DOCTYPE html>
<html lang="en">

<?php
    require_once('session.php');
    require_once("database.php");
    $db = db_connect();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daraja Williams">        
    <meta name="description" content="Allows users to search for past entries">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <script src="js/entryScript.js" defer></script>
    <title>Search Entries Page</title>
</head>

<!-- Retrieve Matching Records -->
<!-- If no search criteria is entered all records matching user's id are retrieved -->
<?php
// Handle form values sent by search.php
// TODO: is the above comment accurate if this php code appears in the file search.php itself?
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
    $user_id = $_SESSION['user_id']; // get the user id from the session
    $start = $_POST['startDate']; // access the form data
    $end = $_POST['endDate'];
    $mood = $_POST['mood'];

    //search with no dates
    $entry_search = "SELECT entry_id,date,title FROM entries WHERE user_id = '$user_id'";

    //search with a start date only
    if (!empty($start) && empty($end)){
        $entry_search .= " AND date >= '$start'";
    }

    //search with a end date only
    elseif (empty($start) && !empty($end)){
        $entry_search .= " AND date <= '$end'";
    }

    //search with a start and end date
    elseif (!empty($start) && !empty($end)){
        $entry_search .= " AND date BETWEEN '$start' AND '$end'";
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

<body>

    <div id="banner_cont"> 
        <!-- insert the header and navigation bar -->
        <?php include("header.php");?>
        <?php include("nav_bar.php");?>
    </div>

    <div id="page-cont"> <!-- container for the page's content, common to all -->

        <h2 class="page_heading">Search Entries</h2>

<!-- TODO: form's variables should be renamed to "start_date" style for consistency, 
 but then changes will need to match that elsewhere -->        
        <form action="search.php" method="POST" id="search_form" class="page_form">

            <!-- Optional Search Fields -->
            <div id="search_fields">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate"> 
                    
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate"> 
                    
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

            <div id="search_wrapper" class="button_wrapper">
                <button type="submit">Search</button>
            </div>

        </form>

        <!-- Display the search results -->
        <div id="results_cont"> 

<!-- TODO is checking the session still necessary after requiring it above? --> 
            <!-- Check if user's session is valid -->
            <?php if (isset($start)){ ?>

                <!-- Adjusted Heading for Different Search Criteria -->
                <h3 id="results_heading" class="page_subheading">
                    <?php 
                        //results with no set dates
                        if (empty($start) && empty($end)){  
                            echo "All Entries";
                        }
                        //results with a start date only
                        elseif (!empty($start) && empty($end)){  
                            echo "Entries since: $start";
                        }
                        //results with a end date only
                        elseif (empty($start) && !empty($end)){
                            echo "Entries before: $end";
                        }
                        //results with a start and end date
                        elseif (!empty($start) && empty($end)){
                            echo "Entries between: $start and $end";
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