<?php
// Assuming you have a database connection established already

// Check if the query parameter is set
if(isset($_POST['query'])) {

    include "db_connection.php";
    // Get the SQL query from the POST request
    $sqlQuery = $_POST['query'];

    // Execute the SQL query
    $result = mysqli_query($$db, $sqlQuery);

    if ($result) {
        // Fetch the result set as an associative array
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        // Return the fetched data as JSON
        echo json_encode($rows);
    } else {
        // Handle query execution error
        echo json_encode(array('error' => 'Error executing SQL query'));
    }
} else {
    // Handle case where query parameter is not set
    echo json_encode(array('error' => 'No query parameter provided'));
}
?>
