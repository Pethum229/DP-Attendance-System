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

                switch($currentDayName){
                    case "Sunday":
                        $day = "1";
                        break;
                    case "Monday":
                        $day = "2";
                        break;
                    case "Tuesday":
                        $day = "3";
                        break;
                    case "Wednesday":
                        $day = "4";
                        break;     
                    case "Thursday":
                        $day = "5";
                        break;
                    case "Friday":
                        $day = "6";
                        break;
                    case "Saturday":
                        $day = "7";
                        break;   
                }

                $timeTable01 = $day.'1';
                $timeTable02 = $day.'2';
                $timeTable03 = $day.'3';
                $timeTable04 = $day.'4';
                $timeTable05 = $day.'5';
                $timeTable06 = $day.'6';
                $timeTable07 = $day.'7';
                $timeTable08 = $day.'8';

            ?>

            <?php echo "<h2>$currentDayName 5.30 AM - 7.30 AM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable01));
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
            <!-- Structre of Time Table 01 <-End-> -->

            <?php echo "<h2>$currentDayName 7.30 AM - 9.30 AM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable02));
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
            <!-- Structre of Time Table 02 <-End-> -->

            <?php echo "<h2>$currentDayName 9.30 AM - 11.30 AM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable03));
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
            <!-- Structre of Time Table 03 <-End-> -->

            <?php echo "<h2>$currentDayName 11.30 AM - 1.30 PM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable04));
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
            <!-- Structre of Time Table 04 <-End-> -->

            <?php echo "<h2>$currentDayName 1.30 PM - 3.30 PM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable05));
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
            <!-- Structre of Time Table 05 <-End-> -->

            <?php echo "<h2>$currentDayName 3.30 PM - 5.30 PM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable06));
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
            <!-- Structre of Time Table 06 <-End-> -->

            <?php echo "<h2>$currentDayName 5.30 PM - 7.30 PM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable07));
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
            <!-- Structre of Time Table 07 <-End-> -->

            <?php echo "<h2>$currentDayName 7.30 PM - 9.30 PM Students List ($currentDate)</h2>"; ?>
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
                            $time_table->execute(array($timeTable08));
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
            <!-- Structre of Time Table 08 <-End-> -->


        </div>
    </section>
</body>
</html>