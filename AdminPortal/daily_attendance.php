<?php 
    $page_id=4;
    include "layout.php"; 

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }

?>
    <title>Daily Attendance | Admin Portal of DP Attendance System</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        section{
            margin:0 auto;
        }
        .filters{
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:rgba(13, 17, 23, 0.9);
            padding:10px 5px;
            margin-bottom:20px;
            border-radius:10px;
        }
        .filters select{
            background:transparent;
            border:none;
            border-bottom:1px solid gray;
            color:gray;
            padding-bottom:3px;
        }
        .filters select:focus{
            background:rgba(13, 17, 23, 0.9);
            border:none;
            opacity:0.5;
        }
        .filters input{
            margin-left:20px;
            background:transparent;
            border:none;
            border-bottom:1px solid gray;
            text-align:center;
            padding-bottom:3px;
        }
        .row{
            background:#11161d;
            margin:20px;
            padding:20px 40px;
            border-radius:20px;
        }
        table thead td{
            background:var(--blue);
            color:black;
            font-weight:600;
        }
        table thead td ion-icon{
            vertical-align:text-top;
        }
        table thead td ion-icon:hover{
            color:white;
        }
        table tbody td{
            color:var(--white);
        }
        tbody tr:nth-child(even){
            background-color: black; 
        }
        tbody tr:nth-child(odd){
            background-color: rgba(13, 17, 23, 0.4); 
        }
        .row tbody a ion-icon{
            font-size:18px;
            text-align:center;
            margin:0 3px;
        }
        .row thead td:last-child{
            text-align:center;
        }
        .exportBtn{
            background-color: #2d3748;
            padding: 5px 10px;
            border:none;
            border-radius: 0px 8px 0px 8px;
            color: var(--white);
            text-decoration: none;
        }
        .exportBtn:hover{
            background-color: transparent;
            border: 1px solid var(--blue);
            color: var(--blue);
        }
        .filterBtn:hover{
            background:var(--blue);
            color:black !important;
        }
        #pagination{
            margin:0 10px;
        }
        #pagination a{
            text-decoration:none;
        }
        .pagination{
            width: fit-content;
            background:#0e1118;
            padding:5px 20px;
            border-radius:10px;
            display:flex;
        }

    </style>
</head>
<body>
    <section>
        <div class="row">
            <div class="filters">
                <form>
                    <select name="rows" id="rows">
                        <option value="0">Select Row Count</option>
                        <option value="1">5</option>
                        <option value="2">10</option>
                        <option value="3">25</option>
                        <option value="4">50</option>
                        <option value="5">100</option>
                    </select>
                    <input type="text" name="student" placeholder="Search by Name or ID">
                    <input style="border:1px solid white; padding:2px 15px; color:white;" name="filter" class="filterBtn" type="submit" value="Filter">
                </form>
                <button type="submit" class="exportBtn" onclick="Export()">
                    Export
                    <ion-icon name="download-outline"></ion-icon>
                </button>
            </div>
            <!-- Structre of Daily Loggedin Student Table <-Start-> -->
            <!-- <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Student ID<ion-icon id="sId" name="arrow-up-outline"></ion-icon></td>
                            <td>Student Name<ion-icon id="sName" name="arrow-up-outline"></ion-icon></td>
                            <td>Projects Completed (Today)<ion-icon id="pCompleted" name="arrow-up-outline"></ion-icon></td>
                            <td>Time In<ion-icon id="timeIn" name="arrow-up-outline"></ion-icon></td>
                            <td>Time Out<ion-icon id="timeOut" name="arrow-up-outline"></ion-icon></td>
                            <td>Log Date</td>
                        </tr>
                    </thead>
                    <tbody> -->


                    <?php
                        include "../db_connection.php";
                            
                        $date = date('Y-m-d');
                            
                        // Function for displaying records
                        function displayRecords($row,$time_difference_readable){
                            echo "<tr>";
                            echo "<td>" . $row['StudentID'] . "</td>";
                            echo "<td>" . $row['StudentName'] . "</td>";
                            echo "<td>" . $row['CompletedProjects'] . "</td>";
                            echo "<td>" . $row['TimeIn'] . "</td>";
                            echo "<td>" . $row['TimeOut'] . "</td>";
                            echo "<td>" . $row['LogDate'] . "</td>";
                            echo "<td>" . $time_difference_readable . "</td>";
                            echo "</tr>";
                        }
                        
                        $limit = 25; // Items per page
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number in URL or set default value to 1
                        
                        // Check if user clicked search button
                        if (isset($_GET['filter']) && !empty($_GET['filter'])){
                            // Get SearchBar Value
                            $name = $_GET['student'];
                        
                            // Get Limitation Value
                            if (!empty($_GET['rows'])){
                                $rows = $_GET['rows'];
                            
                                switch($rows){
                                    case "0":
                                        $limit = 25;
                                        break;
                                    case "1":
                                        $limit = 5;
                                        break;
                                    case "2":
                                        $limit = 10;
                                        break;
                                    case "3":
                                        $limit = 25;
                                        break;
                                    case "4":
                                        $limit = 50;
                                        break;
                                    case "5":
                                        $limit = 100;
                                        break;
                                }
                            }
                        
                            $filtered = "SELECT du.StudentID, du.TimeIn, du.TimeOut, du.LogDate, s.StudentName, du.CompletedProjects 
                                         FROM daily_users du
                                         JOIN students s ON du.StudentID = s.StudentID
                                         WHERE du.LogDate = '$date'";
                        
                            if (!empty($name)){
                                $filtered .= " AND (s.StudentID LIKE '%$name%' OR s.StudentName LIKE '%$name%')";
                            }
                        
                            global $rowCounts;
                            $rowCounts = "";
                        
                            $getCount = $db->prepare($filtered);
                            $getCount->execute(array());
                            $rowCounts = $getCount->rowCount();
                        
                            // Calculate how many items will show based on page number
                            $finalLimit = ($currentPage - 1) * $limit;
                            $filtered .= " LIMIT $limit OFFSET $finalLimit";
                            $list = $db->prepare($filtered);
                            $list->execute(array());
                            $lData = $list->fetchAll();
                        
                            echo "<table class='table table-bordered'>"; // Start the table
                            echo "<thead>";
                            echo "<tr>";
                            echo "<td>Student ID<ion-icon id='sId' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Student Name<ion-icon id='sName' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Projects Completed (Today)<ion-icon id='pCompleted' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Time In<ion-icon id='timeIn' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Time Out<ion-icon id='timeOut' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Log Date</td>";
                            echo "<td>Time Duration</td>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                        
                            foreach ($lData as $row){

                                // Get difference of 2 time periods
                                if (isset($row['TimeIn']) && isset($row['TimeOut']) && !empty($row['TimeIn']) && !empty($row['TimeOut'])) {
                                
                                    list($in_hours, $in_minutes, $in_seconds) = explode(':', $row['TimeIn']);
                                    list($out_hours, $out_minutes, $out_seconds) = explode(':', $row['TimeOut']);
                                
                                    $time_in_seconds = $in_hours * 3600 + $in_minutes * 60 + $in_seconds;
                                    $time_out_seconds = $out_hours * 3600 + $out_minutes * 60 + $out_seconds;
                                
                                    $time_difference_seconds = $time_out_seconds - $time_in_seconds;
                                
                                    $time_difference_hours = floor($time_difference_seconds / 3600);
                                    $time_difference_minutes = floor(($time_difference_seconds % 3600) / 60);
                                    $time_difference_seconds_remaining = $time_difference_seconds % 60;
                                
                                    $time_difference_readable = sprintf('%02d:%02d:%02d', $time_difference_hours, $time_difference_minutes, $time_difference_seconds_remaining);
                                } else {
                                    $time_difference_readable = "N/A";
                                }

                                displayRecords($row,$time_difference_readable);
                            }
                        
                            echo "</tbody>";
                            echo "</table>"; // End the table
                        } else {
                            $finalLimit = ($currentPage - 1) * $limit;
                            $statement = $db->prepare("SELECT du.StudentID, du.TimeIn, du.TimeOut, du.LogDate, s.StudentName, du.CompletedProjects 
                                                        FROM daily_users du
                                                        JOIN students s ON du.StudentID = s.StudentID
                                                        WHERE du.LogDate = '$date'
                                                        LIMIT $limit OFFSET $finalLimit;");
                            $statement->execute();
                            $rowCounts = $statement->rowCount();
                        
                            $data = $statement->fetchAll();
                        
                            echo "<table class='table table-bordered'>"; // Start the table
                            echo "<thead>";
                            echo "<tr>";
                            echo "<td>Student ID<ion-icon id='sId' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Student Name<ion-icon id='sName' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Projects Completed (Today)<ion-icon id='pCompleted' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Time In<ion-icon id='timeIn' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Time Out<ion-icon id='timeOut' name='arrow-up-outline'></ion-icon></td>";
                            echo "<td>Log Date</td>";
                            echo "<td>Time Duration</td>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                        
                            foreach ($data as $row) {

                                // Get difference of 2 time periods
                                if (isset($row['TimeIn']) && isset($row['TimeOut']) && !empty($row['TimeIn']) && !empty($row['TimeOut'])) {

                                    list($in_hours, $in_minutes, $in_seconds) = explode(':', $row['TimeIn']);
                                    list($out_hours, $out_minutes, $out_seconds) = explode(':', $row['TimeOut']);
                                
                                    $time_in_seconds = $in_hours * 3600 + $in_minutes * 60 + $in_seconds;
                                    $time_out_seconds = $out_hours * 3600 + $out_minutes * 60 + $out_seconds;
                                
                                    $time_difference_seconds = $time_out_seconds - $time_in_seconds;
                                
                                    $time_difference_hours = floor($time_difference_seconds / 3600);
                                    $time_difference_minutes = floor(($time_difference_seconds % 3600) / 60);
                                    $time_difference_seconds_remaining = $time_difference_seconds % 60;
                                
                                    $time_difference_readable = sprintf('%02d:%02d:%02d', $time_difference_hours, $time_difference_minutes, $time_difference_seconds_remaining);
                                } else {
                                    $time_difference_readable = "N/A";
                                }
                                displayRecords($row,$time_difference_readable);
                            }
                        
                            echo "</tbody>";
                            echo "</table>"; // End the table
                        }
                        
                        // Pagination
                        $url = $_SERVER['REQUEST_URI'];
                        if (isset($_GET['page'])){
                            $currentPageName = substr($url, strrpos($url, "?") + 8);
                        } else {
                            $currentPageName = substr($url, strrpos($url, "?") + 1);
                        }
                        
                        // Get total record count
                        $countItem = $db->prepare("SELECT COUNT(*) as total FROM `daily_users` WHERE `LogDate`='$date'");
                        $countItem->execute();
                        $tempResult = $countItem->fetch(PDO::FETCH_ASSOC);
                        $totalItems = $tempResult['total'];
                        
                        // Display error messages when no search result related to search
                        if ($rowCounts == 0){
                            echo "<div class='searchError'></div>";
                        }
                        
                        // Calculate number of pages needed to display all records
                        $pageCount = ceil($rowCounts / $limit);
                        
                        // Pagination links
                        $previousPage = $currentPage - 1;
                        $nextPage = $currentPage + 1;
                        
                        echo "<div class='pagination'>";
                        if ($currentPage != 1){
                            echo "<div id='pagination'>";
                            echo "<a href='daily_attendance.php?page=$previousPage&$currentPageName' class='pg'>Back</a>";
                            echo "</div>";
                        }
                        
                        for ($i = 1; $i <= $pageCount; $i++){
                            echo "<div id='pagination'>";
                            echo "<a href='daily_attendance.php?page=$i&$currentPageName' class='pg'>$i</a>";
                            echo "</div>";
                        }
                        
                        if ($currentPage != $pageCount && $rowCounts != 0){
                            echo "<div id='pagination'>";
                            echo "<a href='daily_attendance.php?page=$nextPage&$currentPageName' class='pg'>Next</a>";
                            echo "</div>";
                        }
                        echo "</div>";
                        ?>

                <!-- Structre of Daily Loggedin Student Table <-End-> -->
        </div>
    </section>
    </div>
</div>

    <script>
        function Export(){
            var conf = confirm("Please confirm if you wish to proced in exporting the attendance in to Excel File");
            if(conf==true){
                window.open("../export.php",'_blank');
            }
        }

        // Change arrow
        // Function to toggle ion-icon name attribute
        function toggleIcon(iconId) {
            var ionIcon = document.getElementById(iconId);

            if (ionIcon.getAttribute('name') === 'arrow-up-outline') {
                ionIcon.setAttribute('name', 'arrow-down-outline');
            } else {
                ionIcon.setAttribute('name', 'arrow-up-outline');
            }
        }

        // Add click event listeners to each ion-icon
        document.getElementById('sId').addEventListener('click', function() {
            toggleIcon('sId');
        });

        document.getElementById('sName').addEventListener('click', function() {
            toggleIcon('sName');
        });

        document.getElementById('pCompleted').addEventListener('click', function() {
            toggleIcon('pCompleted');
        });

        document.getElementById('timeIn').addEventListener('click', function() {
            toggleIcon('timeIn');
        });
        document.getElementById('timeOut').addEventListener('click', function() {
            toggleIcon('timeOut');
        });
    </script>
</body>
</html>