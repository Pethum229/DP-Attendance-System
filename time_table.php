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

                            $sql = $db->prepare("SELECT dt.`StudentID`,s.`StudentName` FROM `daily_time_tables` dt 
                                                        JOIN `students` s ON dt.`StudentID` = s.`StudentID`
                                                            WHERE dt.DateNTime = ?");
                            $sql->execute(array('1'));
                            while ($row = $sql -> fetch (PDO::FETCH_ASSOC)){      
                        ?>
                            <tr>
                                <td><?php echo $row['ID'] ?></td>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['StudentName'] ?></td>
                                <td><?php echo $row['PhoneNumber'] ?></td>
                                <td><?php echo $row['ProjectsCompleted'] ?></td>
                                <td>
                                    <a href=""><img class="buttonIcons" src="../images/view-eye-interface-symbol.png" alt="View Button"></a>
                                    <a href=""><img class="buttonIcons" src="../images/edit-button.png" alt="Edit Button"></a>
                                    <a href=""><img class="buttonIcons" src="../images/delete-button.png" alt="Delete Button"></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success pull-right" onclick="Export()">
                    <i class="fa fa-file-excel-o fa-fw">Export to Excel</i>
                </button>
                <!-- Structre of Time Table <-End-> -->
        </div>
    </section>
</body>
</html>