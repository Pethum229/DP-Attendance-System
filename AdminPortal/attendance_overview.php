<?php include "analytics.php" ?>
<style>
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
    #week , #month{
        
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