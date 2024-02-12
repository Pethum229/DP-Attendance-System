<?php 
    $page_id=1;
    include "layout.php";

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }

    if(isset($_SESSION['check'])){
        echo "<div id='chkStudents'></div>";
    }elseif(isset($_SESSION['timetable'])){
        echo "<div id='timetable'></div>";
    }
    
    if(isset($_SESSION['check']) || isset($_SESSION['timetable'])){
        echo "<script>
                setTimeout(function() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('GET', 'session_unset.php', true);
                    xhttp.send();
                }, 5000);
              </script>";
    }

?>
<title>Dashboard | Admin Portal</title>
<style>
    .cardBox{
        position:relative;
        width:100%;
        padding:20px;
        display:grid;
        grid-template-columns:repeat(4,1fr);
        grid-gap:30px;
    }
    .cardBox .card{
        position: relative;
        background: #11161d;
        padding:30px;
        border-radius:20px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        cursor:pointer;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
    }
    .cardBox .card .numbers{
        position: relative;
        font-weight:500;
        font-size:2.5em;
        color:var(--blue);
    }
    .cardBox .card .cardName{
        color:var(--black2);
        font-size:1.1em;
        margin-top:5px;
        text-align:center;
    }
   .iconBx ion-icon{
        font-size:3.5em;
        color:var(--black2);
    }
    .cardBox .card:hover{
        background:var(--blue);
    }
    .cardBox .card:hover .numbers,
    .cardBox .card:hover .cardName,
    .cardBox .card:hover .iconBx{
        color:var(--white);
    }

    /* Data List */
    .details{
        position: relative;
        width:100%;
        padding:20px;
        display:grid;
        grid-template-columns:2fr 1fr;
        grid-gap:30px;
        /* margin-top:10px; */
    }
    .details .lastAttendance{
        position:relative;
        display:grid;
        min-height:200px;
        background:#11161d;
        padding:20px;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .cardHeader{
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-weight:600;
        color:var(--blue);
        height:fit-content;
    }
    .btn{
        position:relative;
        padding:5px 10px;
        background:var(--blue);
        text-decoration:none;
        color:var(--white);
        border-radius:6px;
    }
    .btn:hover{
        color:#11161d;
        font-weight:bold;
        border-radius:0 50px 50px 0;
    }
    .details .table{
        width:100%;
        border-collapse:collapse;
        margin-top:10px;
    }
    .details table thead td{
        font-weight:600;
        color:var(--white);
    }
    .details .lastAttendance table tr{
        color:var(--black2);
        border-bottom:1px solid rgba(255,255,255,0.4);
    }
    .details .lastAttendance table tr:last-child{
        border-bottom:none;
    }
    .details .lastAttendance table tbody tr:hover{
        background:var(--blue);
        color:var(--white);
        border-radius:10px;
    }
    .details .lastAttendance table tr td{
        padding:10px;
    }
    .details .lastAttendance table tr td:last-child{
        text-align:center;
    }
    .details .lastAttendance table tr td:nth-child(3){
        text-align:center;
    }

    /* New Students */
    .highPerformance{
        position: relative;
        display:grid;
        min-height:500px;
        padding:20px;
        background:#11161d;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .highPerformance .imgBx{
        position: relative;
        width:40px;
        height:40px;
        border-radius:50%;
        overflow:hidden;
    }
    .highPerformance .imgBx img{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        object-fit:cover;
    }
    .highPerformance table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .highPerformance table tr td{
        padding:12px 10px;
    }
    .highPerformance table tr td h4{
        font-size:16px;
        font-weight:500;
        line-height:1.2em;
    }
    .highPerformance table tr td h4 span{
        font-size:14px;
        color:var(--black2);
    }
    .highPerformance table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .highPerformance table tr:hover td h4 span{
        color:var(--white);
    }
    .one{
        color:#FFD700;
        position: relative;
    }
    .two{
        color:#800080;
        position: relative;
    }
    .three{
        color: #C0C0C0;
        position: relative;
    }
    .four{
        color:#E5E4E2;
        position: relative;
    }
    .five{
        color:#CD7F32;
        position: relative;
    }


    /* Toast Notifications */

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .notifications{
     font-family: 'Poppins', sans-serif;
     position: fixed;
     top: 30px;
     right: 20px;
    }
    .toast{
        position: relative;
        padding: 10px;
        color: #fff;
        margin-bottom: 10px;
        width: 400px;
        display: grid;
        grid-template-columns: 70px 1fr 70px;
        border-radius: 5px;
        --color: #0abf30;
        background-image: 
            linear-gradient(
                to right, #0abf3055, #22242f 30%
            ); 
        animation: show 0.3s ease 1 forwards  
    }
    .toast i{
        color: var(--color);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: x-large;
    }
    .toast .title{
        font-size: x-large;
        font-weight: bold;
    }
    .toast span, .toast i:nth-child(3){
        color: #fff;
        opacity: 0.6;
    }
    @keyframes show{
        0%{
            transform: translateX(100%);
        }
        40%{
            transform: translateX(-5%);
        }
        80%{
            transform: translateX(0%);
        }
        100%{
            transform: translateX(-10%);
        }
    }
    .toast::before{
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: var(--color);
        width: 100%;
        height: 3px;
        content: '';
        box-shadow: 0 0 10px var(--color);
        animation: timeOut 5s linear 1 forwards
    }
    @keyframes timeOut{
        to{
            width: 0;
        }
    }
    .toast.error{
        --color: #f24d4c;
        background-image: 
            linear-gradient(
                to right, #f24d4c55, #22242F 30%
            );
    }
    .toast.warning{
        --color: #e9bd0c;
        background-image: 
            linear-gradient(
                to right, #e9bd0c55, #22242F 30%
            );
    }
    .toast.info{
        --color: #3498db;
        background-image: 
            linear-gradient(
                to right, #3498db55, #22242F 30%
            );
    }

    </style>

    <?php               
        if(isset($_GET['loggedin'])){
            echo "<div id='loggedin'></div>";
        }
    ?>


    <?php

        include "../db_connection.php";

        // Check Total Students

        $students = $db->prepare("SELECT COUNT(*) AS activeStudentCount FROM `students` WHERE `IsActive`=?");
        $students->execute(array('1'));
        $activeStudents = $students->fetch(PDO::FETCH_ASSOC);

        $activeCount = $activeStudents['activeStudentCount'];


        //Check Daily Attended Students

        $date = date("Y-m-d");

        $aStudents = $db->prepare("SELECT COUNT(*) AS attendedStudents FROM `daily_users` WHERE `LogDate`=?");
        $aStudents->execute(array($date));
        $attendedStudents = $aStudents->fetch(PDO::FETCH_ASSOC);

        $attendedCount = $attendedStudents['attendedStudents'];

        // Check Not Attended Students Today

        $nAStudents = $db->prepare("SELECT COUNT(*) AS notAttendedStudents FROM `daily_time_tables`");
        $nAStudents->execute();
        $notAttendedStudents = $nAStudents->fetch(PDO::FETCH_ASSOC);
        
        $notAttendedCount = $notAttendedStudents['notAttendedStudents'];
        

        // Check Removed Students

        $rtudents = $db->prepare("SELECT COUNT(*) AS removedStudents FROM `students` WHERE `IsActive`=?");
        $rtudents->execute(array('0'));
        $removedeStudents = $rtudents->fetch(PDO::FETCH_ASSOC);

        $removedCount = $removedeStudents['removedStudents'];
    ?>

            <div class="cardBox">
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                    <div class="cardName">Total Students</div>
                    <div class="numbers"><?php echo $activeCount ?></div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                    <div class="cardName">Daily Attended Students</div>
                    <div class="numbers"><?php echo $attendedCount ?></div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="alert-outline"></ion-icon>
                    </div>
                    <div class="cardName">Not Attended Students</div>
                    <div class="numbers"><?php echo $notAttendedCount ?></div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="cardName">Removed Students</div>
                    <div class="numbers"><?php echo $removedCount ?></div>
                </div>
            </div>

            <div class="details">
                <!-- Data List  -->
                <div class="lastAttendance">
                    <div class="cardHeader">
                        <h2>Last Attended Students</h2>
                        <a href="daily_attendance.php" class="btn">View All Students</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Student ID</td>
                                <td>Student Name</td>
                                <td>ClockIn Time</td>
                                <td>ClockOut Time</td>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        include "../db_connection.php";
                        $lastStudents = $db->prepare("SELECT du.`StudentID`, du.`TimeIn`, du.`TimeOut`, s.`StudentName` FROM `daily_users` du JOIN `students` s ON du.`StudentID` = s.`StudentID` ORDER BY du.`ID` DESC LIMIT 7");
                        $lastStudents->execute(array());
                        while ($row = $lastStudents -> fetch (PDO::FETCH_ASSOC)){  

                        ?>

                            <tr>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['StudentName'] ?></td>
                                <td><?php echo $row['TimeIn'] ?></td>
                                <td><?php echo $row['TimeOut'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- New Students -->
                <div class="highPerformance">
                    <div class="cardHeader">
                        <h2>Top Performers</h2>
                    </div>
                    <table>

                    <?php

                    include "../db_connection.php";                 

                    $sql = $db->prepare("SELECT du.*, s.StudentName 
                                        FROM `daily_users` du 
                                        INNER JOIN `students` s ON du.StudentID = s.StudentID 
                                        WHERE du.`LogDate` = ? AND du.`Status` = ? 
                                        ORDER BY du.`CompletedProjects` DESC 
                                        LIMIT 5");
                    $sql->execute(array($date, '1'));
                    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Define images and CSS classes for different rows
                    $imagePaths = ["../images/1.png", "../images/2.png", "../images/3.png", "../images/4.png", "../images/5.png"];
                    $cssClasses = ["one", "two", "three", "four", "five"];

                    // Counter to track the index of the row being processed
                    $rowIndex = 0;

                    foreach ($results as $row) {
                        echo "<tr>";
                        echo "<td width='60px'><div class='imgBx'><img src='" . $imagePaths[$rowIndex] . "'></div></td>";
                        echo "<td><h4 class='" . $cssClasses[$rowIndex] . "'>{$row['StudentName']}<br><span>{$row['StudentID']}</span><span style='position:absolute; bottom:0; right:0;'>{$row['CompletedProjects']} Projects</span></h4></td>";
                        echo "</tr>";
                    
                        $rowIndex++;
                    }

                    ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="notifications"></div>

    <script src="../app.js"></script>
</body>
</html>