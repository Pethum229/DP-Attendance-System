<?php include "layout.php" ?>
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
    select{
        color:yellow;
        background:transparent;
        padding:5px 15px;
    }
    select option{
        background:#11161d;
    }
</style>
<body>

<?php
    include "../db_connection.php";
    
    if (isset($_GET['search']) && $_GET['day'] !=0) {
        $dayNumber = $_GET['day'];
    
        $sql = $db->prepare("SELECT SUBSTRING(DateAndTime, 2, 1) AS SecondDigit, COUNT(*) AS Count
                             FROM time_tables
                             WHERE LEFT(DateAndTime, 1) = ?
                             GROUP BY SUBSTRING(DateAndTime, 2, 1)
                            ");
        $sql->execute(array($dayNumber));
    
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $time[] = $row['SecondDigit'];
            $count[] = $row['Count'];
        }

        // Change original array values

        $array = $time;
            
        // Define the mapping between values and time ranges
        $mapping = array(
            1 => '5.30AM - 7.30AM',
            2 => '7.30AM - 9.30AM',
            3 => '9.30AM - 11.30AM',
            4 => '11.30AM - 1.30PM',
            5 => '1.30PM - 3.30PM',
            6 => '3.30PM - 5.30PM',
            7 => '5.30PM - 7.30PM',
            8 => '7.30PM - 9.30PM'
        );
        
        // Iterate through the array and replace each value with its corresponding time range
        foreach ($array as $key => $value) {
            if (isset($mapping[$value])) {
                $array[$key] = $mapping[$value];
            } else {
                // Handle cases where the value is not mapped (optional)
                $array[$key] = 'Unknown';
            }
        }


    }else{
        $sql = $db->prepare("SELECT RIGHT(DateAndTime, 1) AS LastIndex, COUNT(*) AS Count
                             FROM time_tables
                             GROUP BY LastIndex");
        $sql->execute();
    
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $time[] = $row['LastIndex'];
            $count[] = $row['Count'];
        }

        // Change original array values

        $array = $time;

        // Define the mapping between values and time ranges
        $mapping = array(
            1 => '5.30AM - 7.30AM',
            2 => '7.30AM - 9.30AM',
            3 => '9.30AM - 11.30AM',
            4 => '11.30AM - 1.30PM',
            5 => '1.30PM - 3.30PM',
            6 => '3.30PM - 5.30PM',
            7 => '5.30PM - 7.30PM',
            8 => '7.30PM - 9.30PM'
        );

        // Iterate through the array and replace each value with its corresponding time range
        foreach ($array as $key => $value) {
            if (isset($mapping[$value])) {
                $array[$key] = $mapping[$value];
            } else {
                // Handle cases where the value is not mapped (optional)
                $array[$key] = 'Unknown';
            }
        }


    }
?>
    <section>
        <!-- Charts -->
        <div class="anlytics">
            <div class="tabs">
                <a class="tab-link" href="summary.php">Summary</a>
                <a class="tab-link" href="attendance_overview.php">Attendance Overview</a>
                <a class="tab-link clicked" href="time_table_overview.php">Time Table Overview</a>
                <a class="tab-link" href="new_student_overview.php">New Students Overview</a>
            </div>
            <div class="dailyAttendance">
                <h2>
                    <?php if(isset($_GET['search'])){
                        switch($_GET['day']){
                            case "0":
                                echo "All Days";
                                break;
                            case "1":
                                echo "Sunday";
                                break;
                            case "2":
                                echo "Monday";
                                break;
                            case "3":
                                echo "Tuesday";
                                break;
                            case "4":
                                echo "Wednesday";
                                break;
                            case "5":
                                echo "Thursday";
                                break;
                            case "6":
                                echo "Friday";
                                break;
                            case "7":
                                echo "Saturday";
                                break;
                        }
                    }else{
                        echo "All Days ";
                    }
                    ?> 
                    Time Table Overview
                </h2>
                <form>
                    <select name="day" id="day">
                        <option value="0">All Days</option>
                        <option value="1">Sunday</option>
                        <option value="2">Monday</option>
                        <option value="3">Tuesday</option>
                        <option value="4">Wednesday</option>
                        <option value="5">Thursday</option>
                        <option value="6">Friday</option>
                        <option value="7">Saturday</option>
                    </select>
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
      type: 'line',
      data: {
        labels: <?php echo json_encode($array); ?>,
        datasets: [{
          label: 'Students Count',
          data: <?php echo json_encode($count) ?>,
          borderColor: 'rgb(230, 192, 0)',
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