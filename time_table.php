<?php include "inc_header.php"; ?>
    <title>Time Table</title>
</head>
<body>
    <section class="container">
        <div class="row">
            <!-- Structre of  Time Table <-Start-> -->
            <h1>Time Table</h1>
            <?php
                $currentDate = date('Y-m-d');
                $currentDayName = date('l');
                echo "<h2>$currentDayName 5.30 AM - 7.30 AM Students List ($currentDate)</h2>";
            ?>
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Student ID</td>
                            <td>Student Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "db_connection.php";

                            $time_table = $db->prepare("SELECT dt.`StudentID`,s.`StudentName` FROM `daily_time_tables` dt 
                                                        JOIN `students` s ON dt.`StudentID` = s.`StudentID`
                                                            WHERE dt.DateNTime = ?");
                            $time_table->execute(array('18'));
                            while ($row = $time_table -> fetch (PDO::FETCH_ASSOC)){      
                        ?>
                            <tr>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['StudentName'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Structre of Time Table <-End-> -->
        </div>
    </section>
</body>
</html>