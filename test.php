<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table id="studentsTable">
        <thead>
            <tr>
                <th>Student ID <ion-icon id="sId" name="arrow-up-outline"></ion-icon></th>
                <!-- Other table headers -->
            </tr>
        </thead>
        <tbody>
            <!-- Table rows filled with student data -->
        </tbody>
    </table>

<script>

    // Get the table header with the arrow icon
    const sortIcon = document.getElementById('sId');
    
    // Initial sorting order
    let sortOrder = 'ASC'; // Default to ascending order
    
    // Add a click event listener to the arrow icon
    sortIcon.addEventListener('click', function() {
        // Toggle sorting order
        sortOrder = sortOrder === 'ASC' ? 'DESC' : 'ASC';
    
        // Update the icon based on the sorting order
        if (sortOrder === 'ASC') {
            sortIcon.setAttribute('name', 'arrow-up-outline');
        } else {
            sortIcon.setAttribute('name', 'arrow-down-outline');
        }
    
        // Fetch data from the database with the updated sorting order
        fetchData();
    });
    
    // Function to fetch data from the database with the current sorting order
    function fetchData() {
        // Send an AJAX request to fetch data from the server
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the table with the fetched data
                    updateTable(xhr.responseText);
                } else {
                    console.error('Error fetching data:', xhr.statusText);
                }
            }
        };
    
        // Construct the SQL query based on the current sorting order
        const sqlQuery = `SELECT * FROM students ORDER BY StudentID ${sortOrder}`;
    
        // Send the SQL query to the server
        xhr.open('POST', 'test1.php'); // Change 'fetch_data.php' to your server-side script
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(`query=${sqlQuery}`);
    }
    
    // Function to update the table with the fetched data
    function updateTable(data) {
        // Parse the JSON data and update the table
        const students = JSON.parse(data);
        // Update the table with the fetched data
    }
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>