<?php include "inc_header.php"; ?>
    <title>Time Table</title>
    <style>
        .row{
            display:flex;
            flex-wrap:wrap;
        }
        .container{
            background-color: rgba(13, 17, 23, 0.9);
            padding: 20px;
            border: 1px solid #4b5563;
            margin: 20px;
            border-radius: 8px;
            width:45%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .main{
            font-family:var(--actor);
            text-align:center;
            font-size:50px;
            color:yellow;
            margin-top:20px;
        }
        table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 20px;
          background: rgba(13, 17, 23, 0.6);
          color:#c9d1d9;
          border:1px solid #c9d1d9;
        }
        .container>h2{
            color:var(--accent);
            font-family:var(--roboto);
            font-size:22px;
            text-align:center;
        }

        th, td {
          border: 3px solid var(--white);
          padding: 10px;
          text-align: center;
        }

        th {
          background-color: #3498db;
          color: var(--white);
        }

        tr:nth-child(even) {
          background-color: #3c373d;
        }

        tr:nth-child(odd) {
          background-color: rgba(13, 17, 23, 0.4);
        }
        </style>
</head>
<body>
    <section>
        <h1 class="main">Hathagala DP IT Campus Time Table</h1>
        <div class="row">
            <!-- Structre of  Time Table <-Start-> -->

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
            
            <div class="container">
                <?php echo "<h2>$currentDayName 5.30 AM - 7.30 AM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 01 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 7.30 AM - 9.30 AM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 02 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 9.30 AM - 11.30 AM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 03 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 11.30 AM - 1.30 PM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 04 <-End-> -->
            
            <div class="container">
                <?php echo "<h2>$currentDayName 1.30 PM - 3.30 PM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 05 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 3.30 PM - 5.30 PM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 06 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 5.30 PM - 7.30 PM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 07 <-End-> -->

            <div class="container">
                <?php echo "<h2>$currentDayName 7.30 PM - 9.30 PM Students List ($currentDate)</h2>"; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
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
            </div>
            <!-- Structre of Time Table 08 <-End-> -->


        </div>
    </section>
</body>
</html>