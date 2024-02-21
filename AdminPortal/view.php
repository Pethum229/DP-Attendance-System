<?php
    $page_id=20;
    include "layout.php"; 

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }
    
 ?>
<title>View Students | Admin Portal</title>

<style>
    .view{
        background: #11161d;
        margin: 20px;
        padding: 20px 40px;
        border-radius: 20px;
    }
    .titles{
        display:flex;
        justify-content:center;
        margin-bottom:30px;
        align-items:center;
    }
    .titles h1{
        color:yellow;
    }
    .maleImg{
        font-size:40px;
        color:blue;
    }
    .femaleImg{
        font-size:40px;
        color:pink;
    }
    .view p{
        color:white;
    }
    p span{
        color:gray;
    }
    p{
        padding:5px;
        box-shadow:
    }
    .anlytics{
        display:flex;
        flex-direction:column;
        align-items:center;
    }
    .anlytics h2{
        color: var(--blue);
        text-align:center;
    }
    .chart{
        width:50%;
        margin-top:50px;
    }
</style>

<body>

<?php

include "../db_connection.php";


if (!empty($_GET['studentId'])) {
    $sId = $_GET['studentId'];

    // Query to get total attendance count for a specific student from the students table
    $totalAttendanceQuery = $db->prepare("SELECT TotalAttendance FROM students WHERE StudentID=?");
    $totalAttendanceQuery->execute(array($sId));
    $totalAttendanceResult = $totalAttendanceQuery->fetch(PDO::FETCH_ASSOC);

    // Query to get the sum of days which name included the time_table from time_tables table for the specified student
    $totalCountQuery = $db->prepare("
        SELECT StudentID, SUM(Count) AS TotalCount
        FROM time_tables
        WHERE StudentID = ?
        GROUP BY StudentID
    ");
    $totalCountQuery->execute(array($sId));
    $totalCountResult = $totalCountQuery->fetch(PDO::FETCH_ASSOC);

    if ($totalAttendanceResult && $totalCountResult) {

        $totalAttendance = $totalAttendanceResult['TotalAttendance'];
        $totalCount = $totalCountResult['TotalCount'];

        if($totalCount<$totalAttendance){
            $totalNotAttended = 1;
        }else{
            $totalNotAttended = $totalCount - $totalAttendance;
        }
    } else {
        echo "No data found for StudentID $sId";
    }

    // For Chart
    $labels = array('Attendance Count','Not Attendance Count');
    $dataCount = array($totalAttendance,$totalNotAttended);


    // Get datas

    $view = $db->prepare("SELECT * FROM `students` WHERE `StudentID`=?");
    $view->execute(array($sId));

    if(($view->rowCount()) > 0){
        while ($row = $view->fetch(PDO::FETCH_ASSOC)){
?>
        <section class="view">
            <div class="titles">
                <?php
                    if($row['Gender'] == 1){
                        echo "<ion-icon class='maleImg' name='man-outline'></ion-icon>";
                    } elseif($row['Gender'] == 0){
                        echo "<ion-icon  class='femaleImg' name='woman-outline'></ion-icon>";
                    }
                ?>
                <h1><?php echo $row['StudentName']?>'s Details</h1>
            </div>
            <div class="details">
                <div class="rows">
                    <p>Student Name : <span><?php echo $row['StudentName']?></span></p>
                </div>
                <div class="rows">
                    <p>Student ID : <span><?php echo $row['StudentID']?></span></p>
                    <p>Birthday : <span><?php echo $row['Birthday']?></span></p>
                </div>
                <div class="rows">
                    <p>Address : <span><?php echo $row['Address']?></span></p>
                </div>
                <div class="rows more">
                    <p>Phone Number (Parent) : <span><?php echo $row['PhoneNumber']?></span></p>
                    <p>Whatsapp Number : <span><?php echo $row['WhatsappNumber']?></span></p>
                </div>
                <div class="rows">
                    <p>Email : <span><?php echo $row['Email']?></span></p>
                    <p>Completed Projects : <span><?php echo $row['ProjectsCompleted']?></span></p>
                </div>

                <?php
                    $studentId = $_GET['studentId'];
                    $count = 0;
                    $dates = $db->prepare("SELECT * FROM `time_tables` WHERE `StudentId`=? LIMIT 0, 25");
                    $dates->execute(array($studentId));

                    while ($record = $dates->fetch(PDO::FETCH_ASSOC)){
                        $count++;
                        $date = $record['DateAndTime'];

                        // Get Day and Time
                        $day = $date[0]; // Accessing the first character of the string
                        $time = $date[1];

                        switch($day){
                            case "1":
                                $dayName = "Sunday";
                                break;
                            case "2":
                                $dayName = "Monday";
                                break;
                            case "3":
                                $dayName = "Tuesday";
                                break;
                            case "4":
                                $dayName = "Wednesday";
                                break;     
                            case "5":
                                $dayName = "Thursday";
                                break;
                            case "6":
                                $dayName = "Friday";
                                break;
                            case "7":
                                $dayName = "Saturday";
                                break;   
                        }

                        switch($time){
                            case "1":
                                $timePeriod = "5.30 AM - 7.30 AM";
                                break;
                            case "2":
                                $timePeriod = "7.30 AM - 9.30 AM";
                                break;
                            case "3":
                                $timePeriod = "9.30 AM - 11.30 AM";
                                break;
                            case "4":
                                $timePeriod = "11.30 AM - 1.30 PM";
                                break;     
                            case "5":
                                $timePeriod = "1.30 PM - 3.30 PM";
                                break;
                            case "6":
                                $timePeriod = "3.30 PM - 5.30 PM";
                                break;
                            case "7":
                                $timePeriod = "5.30 PM - 7.30 PM";
                                break;   
                            case "8":
                                $timePeriod = "7.30 PM - 9.30 PM";
                                break;   
                        }
                ?>
                <div class="rows more">
                    <?php echo "<p>Date & Time 0$count : <span> $dayName $timePeriod </span></p>"; ?>
                </div>
                <?php
                    }
                ?>
                <div class="rows">
                    <p>DP IT Campus : <span><?php echo $row['CampusId']?></span></p>
                </div>
                <div class="rows more">
                    <p>Last 5 Days Attendance Status : <span><?php echo $row['AttendanceStatus']?></span></p>
                    <p>Total Attendance Count : <span><?php echo $row['TotalAttendance']?></span></p>
                </div>
            </div>
            <div class="anlytics">
                <h2>Attendance vs Not Attendance</h2>
                <div class="chart">
                    <canvas id="studentAttendance"></canvas>
                </div>
            </div>
        </section>
<?php
        }
    }
}
?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>

            //Student Attendance Overview
            const projects = document.getElementById('studentAttendance');
            new Chart(projects, {
              type: 'pie',
              data: {
                labels: <?php echo json_encode($labels) ?>,
                datasets: [{
                  label: 'Day Count',
                  data: <?php echo json_encode($dataCount) ?>,
                  backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)'
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
        </script>
        </div>
    </div>
</body>
</html>