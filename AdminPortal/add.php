<?php
include "../inc_header.php";
$msg="";

// Add Student Register Details to Database
try{
    include "../db_connection.php";

    // Insert date into students table
    $stmtStudents = $db->prepare("INSERT INTO `students` (`StudentID`,
                                                `StudentName`,
                                                `Address`,
                                                `PhoneNumber`,
                                                `WhatsappNumber`,
                                                `Birthday`,
                                                `Email`,
                                                `ProjectsCompleted`,
                                                `CampusId`)
                                                    VALUES (?,?,?,?,?,?,?,?,?)")->execute(array($_POST['sId'],
                                                                                                $_POST['sName'],
                                                                                                $_POST['address'],
                                                                                                $_POST['pNumber'],
                                                                                                $_POST['wNumber'],
                                                                                                $_POST['birthday'],
                                                                                                $_POST['email'],
                                                                                                $_POST['cProjects'],
                                                                                                $_POST['cName']));

    // Get the last inserted StudentID
    $stmt_last_student_id = $db->query("SELECT StudentID FROM students ORDER BY Id DESC LIMIT 1");
    $lastStudentID = $stmt_last_student_id->fetch(PDO::FETCH_ASSOC)['StudentID'];

    //Insert data into time_tables table
    $stmt_time_tables = $db->prepare("INSERT INTO `time_tables` (`StudentID`, `DateAndTime`,`Count`)VALUES (?,?,?)");

    //Insert date for date and time 01
    $stmt_time_tables -> execute(array($lastStudentID,$_POST['date01']. '' . $_POST['time01'],1));
    //Insert date for date and time 02
    $stmt_time_tables -> execute(array($lastStudentID,$_POST['date02']. '' . $_POST['time02'],1));
    //Insert date for date and time 03
    $stmt_time_tables -> execute(array($lastStudentID,$_POST['date03']. '' . $_POST['time03'],1));

    echo "Date added successfully!";

}catch(PDOException $e){
    $msg.=$e->getMessage();
}
?>
    <title>Add Student</title>
    <style>
        /* Style for hiding/showing the time selection */
        #timeSelection1, #timeSelection2, #timeSelection3 {
            display: none;
        }
    </style>
</head>
<body>
    <form name="registerForm" method="POST">
        <input type="text" name="sId" placeholder="Student Id">
        <input type="text" name="sName" placeholder="Student Name">
        <input type="text" name="address" placeholder="Address">
        <input type="text" name="pNumber" placeholder="Phone Number(Parents)">
        <input type="text" name="wNumber" placeholder="Whatsapp Number">
        <input type="date" name="birthday" placeholder="Birthday">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="cProjects" placeholder="Completed Projects">
        <select name="cName" id="campusName">
            <option value="0">Select Your DP IT Campus</option>
            <option value="28">DP IT Campus Hathagala</option>
            <option value="29">DP IT Campus Udhdhakandara</option>
            <option value="30">DP IT Campus Tangalle</option>
            <option value="31">DP IT Campus Ambalanthota</option>
            <option value="32">DP IT Campus Embilipitiya</option>
        </select>

        <!-- Select Date and Time Fields -->

        <label for="selectDate1">Select Date 01:</label>
        <select name="date01" id="selectDate1" onchange="showTimeSelection1()">
            <option value="0">Select...</option>
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <option value="3">Tuesday</option>
            <option value="4">Wednesday</option>
            <option value="5">Thursday</option>
            <option value="6">Friday</option>
            <option value="7">Saturday</option>
        </select>

        <div id="timeSelection1">
            <label for="selectTime">Select Your Time:</label>
            <select name="time01" id="selectTime">
                <option value="0">Select...</option>
                <option value="1">5.30 AM - 7.30 AM</option>
                <option value="2">7.30 AM - 9.30 AM</option>
                <option value="3">9.30 AM - 11.30 AM</option>
                <option value="4">11.30 AM - 1.30 PM</option>
                <option value="5">1.30 PM - 3.30 PM</option>
                <option value="6">3.30 PM - 5.30 PM</option>
                <option value="7">5.30 PM - 7.30 PM</option>
                <option value="8">7.30 PM - 9.30 PM</option>
            </select>
        </div>

        <!-- Select Date and Time Fields -->

        <label for="selectDate2">Select Date 02:</label>
        <select name="date02" id="selectDate2" onchange="showTimeSelection2()">
            <option value="0">Select...</option>
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <option value="3">Tuesday</option>
            <option value="4">Wednesday</option>
            <option value="5">Thursday</option>
            <option value="6">Friday</option>
            <option value="7">Saturday</option>
        </select>

        <div id="timeSelection2">
            <label for="selectTime">Select Your Time:</label>
            <select name="time02" id="selectTime">
                <option value="0">Select...</option>
                <option value="1">5.30 AM - 7.30 AM</option>
                <option value="2">7.30 AM - 9.30 AM</option>
                <option value="3">9.30 AM - 11.30 AM</option>
                <option value="4">11.30 AM - 1.30 PM</option>
                <option value="5">1.30 PM - 3.30 PM</option>
                <option value="6">3.30 PM - 5.30 PM</option>
                <option value="7">5.30 PM - 7.30 PM</option>
                <option value="8">7.30 PM - 9.30 PM</option>
            </select>
        </div>

        <!-- Select Date and Time Fields -->

        <label for="selectDate3">Select Date 03:</label>
        <select name="date03" id="selectDate3" onchange="showTimeSelection3()">
            <option value="0">Select...</option>
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <option value="3">Tuesday</option>
            <option value="4">Wednesday</option>
            <option value="5">Thursday</option>
            <option value="6">Friday</option>
            <option value="7">Saturday</option>
        </select>

        <div id="timeSelection3">
            <label for="selectTime">Select Your Time:</label>
            <select name="time03" id="selectTime">
                <option value="0">Select...</option>
                <option value="1">5.30 AM - 7.30 AM</option>
                <option value="2">7.30 AM - 9.30 AM</option>
                <option value="3">9.30 AM - 11.30 AM</option>
                <option value="4">11.30 AM - 1.30 PM</option>
                <option value="5">1.30 PM - 3.30 PM</option>
                <option value="6">3.30 PM - 5.30 PM</option>
                <option value="7">5.30 PM - 7.30 PM</option>
                <option value="8">7.30 PM - 9.30 PM</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Register" name="submit">
            <input type="reset" value="Reset Form">
        </div>

    </form>


    <script>
        function showTimeSelection1() {
            var selectDate1 = document.getElementById("selectDate1");
            var timeSelection1 = document.getElementById("timeSelection1");

            // Check if a valid date is selected
            if (selectDate1.value !== "0") {
                timeSelection1.style.display = "block";
            } else {
                timeSelection1.style.display = "none";
            }
        }

        function showTimeSelection2() {
            var selectDate2 = document.getElementById("selectDate2");
            var timeSelection2 = document.getElementById("timeSelection2");

            // Check if a valid date is selected
            if (selectDate2.value !== "0") {
                timeSelection2.style.display = "block";
            } else {
                timeSelection2.style.display = "none";
            }
        }

        function showTimeSelection3() {
            var selectDate3 = document.getElementById("selectDate3");
            var timeSelection3 = document.getElementById("timeSelection3");

            // Check if a valid date is selected
            if (selectDate3.value !== "0") {
                timeSelection3.style.display = "block";
            } else {
                timeSelection3.style.display = "none";
            }
        }
    </script>

</body>
</html>