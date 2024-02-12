<?php
$page_id=6;
include "layout.php";

if(!isset($_SESSION['name'])){
  header("location:../login.php");
  exit();
}


?>
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    .anlytics{
        background:#11161d;
        margin:20px;
        padding: 20px 40px;
        border-radius:20px;
        width:100%;
    }
    .tabs{
        display:flex;
        justify-content:space-between;
        margin-bottom:15px;
    }
    .tabs a{
        text-decoration:none;
        font-size:16px;
        background:black;
        padding:10px 20px;
        border-radius:15px 15px 0 0;
    }
    .tab-link {
        padding: 10px 20px;
        margin-right: 10px;
        background-color: #f5f5f5;
        color: #888;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }
    .tab-link.clicked {
        background-color: #387be2;
        color: #fff;
    }
    .charts{
        display:flex;
        justify-content:space-between;
        flex-wrap:wrap;
    }

    /* Attendance Overview */

    .chart{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        width:48%;
        padding:10px 20px;
        margin-bottom:30px;
    }
    .anlytics h1{
        text-align:center;
        margin-bottom:15px;
        color:var(--blue);
    }
    .charts h2{
        color:white;
        font-size:24px;
        text-align:center;
        margin-bottom:20px;
    }
</style>
<body>

<?php
    include "../db_connection.php";

    // Daily Attendance Chart

    $date = date("Y-m-d");

    $sql = $db->prepare("SELECT COUNT(*) AS userCount FROM daily_users WHERE LogDate =?");
    $sql->execute(array($date));
    $results = $sql->fetch(PDO::FETCH_ASSOC);

    $attendedStudents = $results['userCount'];

    $nAttended = $db->prepare("SELECT COUNT(*) AS notAttended FROM daily_time_tables");
    $nAttended->execute();
    $notAttended = $nAttended->fetch(PDO::FETCH_ASSOC);

    $notAttendedStudents = $notAttended['notAttended'];

    $attendanceOverview = [$attendedStudents,$notAttendedStudents];

    //Projects Completed Chart

    $project = $db->prepare("SELECT 
                                CASE
                                    WHEN ProjectsCompleted >= 0 AND ProjectsCompleted < 50 THEN '0-49'
                                    WHEN ProjectsCompleted >= 50 AND ProjectsCompleted < 100 THEN '50-99'
                                    WHEN ProjectsCompleted >= 100 AND ProjectsCompleted < 150 THEN '100-149'
                                    WHEN ProjectsCompleted >= 150 AND ProjectsCompleted < 200 THEN '150-199'
                                    WHEN ProjectsCompleted >= 200 AND ProjectsCompleted < 250 THEN '200-249'
                                    WHEN ProjectsCompleted >= 250 AND ProjectsCompleted < 300 THEN '250-299'
                                    WHEN ProjectsCompleted >= 300 AND ProjectsCompleted < 350 THEN '300-349'
                                END AS ProjectRange,
                                COUNT(*) AS StudentCount
                            FROM students
                            GROUP BY ProjectRange");
    $project->execute();
    $projectCompleted = $project->fetchAll(PDO::FETCH_ASSOC);

    foreach ($projectCompleted as $row){
        $projectRange[] = $row['ProjectRange'];
        $studentCount[] = $row['StudentCount'];
    }

    // Time In Chart

    $timeIn = $db->prepare("SELECT 
                                CASE
                                    WHEN TIME(TimeIn) >= '05:30:00' AND TIME(TimeIn) < '07:30:00' THEN '5:30:00 - 7:30:00'
                                    WHEN TIME(TimeIn) >= '07:30:00' AND TIME(TimeIn) < '09:30:00' THEN '7:30:00 - 9:30:00'
                                    WHEN TIME(TimeIn) >= '09:30:00' AND TIME(TimeIn) < '11:30:00' THEN '9:30:00 - 11:30:00'
                                    WHEN TIME(TimeIn) >= '11:30:00' AND TIME(TimeIn) < '13:30:00' THEN '11:30:00 - 13:30:00'
                                    WHEN TIME(TimeIn) >= '13:30:00' AND TIME(TimeIn) < '15:30:00' THEN '13:30:00 - 15:30:00'
                                    WHEN TIME(TimeIn) >= '15:30:00' AND TIME(TimeIn) < '17:30:00' THEN '15:30:00 - 17:30:00'
                                    WHEN TIME(TimeIn) >= '17:30:00' AND TIME(TimeIn) < '19:30:00' THEN '17:30:00 - 19:30:00'
                                    WHEN TIME(TimeIn) >= '19:30:00' AND TIME(TimeIn) < '21:30:00' THEN '19:30:00 - 21:30:00'
                                END AS TimeRange,
                                COUNT(*) AS RecordCount
                            FROM daily_users
                            WHERE LogDate = ?
                            GROUP BY TimeRange");
    $timeIn->execute(array($date));
    $timeSlot = $timeIn->fetchAll(PDO::FETCH_ASSOC);

    foreach ($timeSlot as $row){
        $timeRange[] = $row['TimeRange'];
        $recordCount[] = $row['RecordCount'];
    }

    // Gender Overview

    $gender = $db->prepare("SELECT COUNT(*) AS MaleFemaleCount FROM `students` WHERE `Gender`=?");
    $gender->execute(array('1'));
    $maleCount = $gender->fetch(PDO::FETCH_ASSOC);
    
    $male = $maleCount['MaleFemaleCount'];
    
    $gender->execute(array('0'));
    $femaleCount = $gender->fetch(PDO::FETCH_ASSOC);

    $female = $femaleCount['MaleFemaleCount'];

    $genderOverview = [$male,$female];
?>
    <section>
        <!-- Charts -->
        <div class="anlytics">
            <div class="tabs">
                <a class="tab-link clicked" href="summary.php">Summary</a>
                <a class="tab-link" href="attendance_overview.php">Attendance Overview</a>
                <a class="tab-link" href="time_table_overview.php">Time Table Overview</a>
                <a class="tab-link" href="new_student_overview.php">New Students Overview</a>
            </div>

            <h1>Summary of Analytics</h1>

            <div class="charts">

                <!-- Daily Attendance Chart --> 

                <div class="chart">
                    <h2>Today Attendance Overview</h2>
                    <canvas id="dailyAttendance"></canvas>
                </div>

                <!-- Project Completed Chart -->

                <div class="chart">
                    <h2>Project Completed Overview</h2>
                    <canvas id="projectsCompleted"></canvas>
                </div>

                <!-- Time Slot Attendance -->

                <div class="chart">
                    <h2>Today Time Slot Attendance</h2>
                    <canvas id="timeAttendance"></canvas>
                </div>
                
                <!-- Gender Overview -->

                <div class="chart">
                    <h2>Gender Overview</h2>
                    <canvas id="genderOverview"></canvas>
                </div>
            </div>
        </div>
    </section>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>

    // Daily Attendance Overview

    const ctx = document.getElementById('dailyAttendance');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Attended Students','Not Attended Students'],
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($attendanceOverview) ?>,
          backgroundColor: [
              'rgba(153, 102, 255, 0.2)',
              'rgba(75, 192, 192, 0.2)'
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

    // Project Completed Overview

    const projects = document.getElementById('projectsCompleted');
    new Chart(projects, {
      type: 'polarArea',
      data: {
        labels: <?php echo json_encode($projectRange) ?>,
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($studentCount) ?>,
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(75, 192, 192)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)',
            'rgb(541, 12, 235)',
            'rgb(54, 12, 25)',
            'rgb(4, 162, 235)'
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

    // Time Slot Chart

    const timeSlot = document.getElementById('timeAttendance');
    new Chart(timeSlot, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($timeRange) ?>,
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($recordCount) ?>,
          backgroundColor: [
              'rgba(153, 102, 255, 0.2)',
              'rgba(75, 192, 192, 0.2)'
          ],
          borderColor:'yellow',
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

    // Gender Overview

    const genderOverview = document.getElementById('genderOverview');
    new Chart(genderOverview, {
      type: 'bar',
      data: {
        labels: ['Male','Female'],
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($genderOverview) ?>,
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor:[
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)'
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

</body>
</html>