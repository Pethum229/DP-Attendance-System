<?php 

include "layout.php" ;

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
        margin-bottom:30px;
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

    /* Attendance Overview */

    .dailyAttendance{
        display:flex;
        flex-direction:column;
        align-items:center;
    }
    .dailyAttendance h2{
        color:var(--blue);
        font-size:24px;
        text-align:center;
        margin-bottom:20px;
    }
    form{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        width:fit-content;
        padding:10px 20px;
        margin-bottom:30px;
    }
    #week{
        border-right:3px solid white;
    }
    form label{
        color:yellow;
    }
</style>
<body>

<?php
    include "../db_connection.php";
    
    if (isset($_GET['search'])) {
        $limit = $_GET['attendanceAnalytics'] == "7" ? 7 : 30;
    
        $sql = $db->prepare("SELECT LogDate, COUNT(*) as UserCount 
                             FROM daily_users 
                             GROUP BY LogDate 
                             ORDER BY LogDate DESC 
                             LIMIT :limit");
        $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();
    
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $day[] = $row['LogDate'];
            $count[] = $row['UserCount'];
        }
    }else{
        $sql = $db->prepare("SELECT LogDate, COUNT(*) as UserCount 
                             FROM daily_users 
                             GROUP BY LogDate 
                             ORDER BY LogDate DESC 
                             LIMIT 7");
        $sql->execute();
    
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $day[] = $row['LogDate'];
            $count[] = $row['UserCount'];
        }
    }
?>
    <section>
        <!-- Charts -->
        <div class="anlytics">
            <div class="tabs">
                <a class="tab-link" href="summary.php">Summary</a>
                <a class="tab-link clicked" href="attendance_overview.php">Attendance Overview</a>
                <a class="tab-link" href="time_table_overview.php">Time Table Overview</a>
                <a class="tab-link" href="new_student_overview.php">New Students Overview</a>
            </div>
            <div class="dailyAttendance">
                <h2>
                    <?php if(isset($_GET['search'])){
                        if($_GET['attendanceAnalytics'] == 7){
                            echo "Weekly ";
                        }else{
                            echo "Monthly ";
                        }
                    }else{
                        echo "Weekly ";
                    }
                    ?> 
                    Attendance Overview
                </h2>
                <form>
                    <label for="week">Weekly</label>
                    <input id="week" required name="attendanceAnalytics" value="7" type="radio">
                    <label for="month">Monthly</label>
                    <input id="month" name="attendanceAnalytics" value="30" type="radio">
                    <input type="submit" name="search" value="Update">
                </form>
                <canvas id="dailyAttendance"></canvas>
            </div>
        </div>
    </section>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Charts
    const ctx = document.getElementById('dailyAttendance');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($day); ?>,
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($count) ?>,
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
          ],
          borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
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