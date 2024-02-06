<?php
include "layout.php";
$msg="";

// Add Student Register Details to Database
if (isset($_POST['submit'])){   
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
                                                    `Gender`,
                                                    `CampusId`,
                                                    `AttendanceStatus`)
                                                        VALUES (?,?,?,?,?,?,?,?,?,?,?)")->execute(array($_POST['sId'],
                                                                                                    $_POST['sName'],
                                                                                                    $_POST['address'],
                                                                                                    $_POST['pNumber'],
                                                                                                    $_POST['wNumber'],
                                                                                                    $_POST['birthday'],
                                                                                                    $_POST['email'],
                                                                                                    $_POST['cProjects'],
                                                                                                    $_POST['gender'],
                                                                                                    $_POST['cName'],
                                                                                                    '1'));
    
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

    $QRID = $_POST['sId'];

    // Check $_POST values
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
}
?>
    <title>Add Students | Admin Portal</title>
    <style>
        /* Style for hiding/showing the time selection */
        #timeSelection1, #timeSelection2, #timeSelection3 {
            display: none;
            width:48%;
            /* display:flex; */
            justify-content:right;
        }
        #qrRemove{
            margin:20px;
            padding:20px;
            /* background:#11161d; */
            border:2px solid black;
            border-radius:20px;
            display:flex;
            justify-content:center;
        }
        #qrRemove img{
            margin-right:30px;
        }
        .QRDownloaded{
            display:flex;
            flex-direction:column;
            align-items:center;
            color:green;
        }
        .QRDownloaded ion-icon{
            font-size:50px;
            color:green;
        }
        .register{
            margin:20px;
            background:#11161d;
            padding:20px;
            border-radius:20px;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .register h1{
            font-family:var(--roboto);
            text-align:center;
            color:var(--blue);
            margin-bottom:20px;
        }
        form{
            display:flex;
            flex-direction:column;
            width:70%;
        }
        .inputFlex{
            display:flex;
            width:100%;
            justify-content:space-between;
        }
        form input{
            background:transparent;
            border:none;
            color:var(--white);
            margin:10px 0;
            padding:5px 10px 5px 10px;
            box-shadow:0 1px 5px rgb(0 231 255 / 22%);
            border-radius:10px;
            height:40px;
        }
        form input::placeholder{
            color:#fff;
        }
        .inputWidth{
            width:48%;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1); /* Invert the color */
        }
        form select{
            background:transparent;
            border:none;
            color:var(--white);
            margin:10px 0;
            padding:5px 0 5px 10px;
            box-shadow:0 1px 5px rgb(0 231 255 / 22%);
            border-radius:10px;
            height:40px;
        }
        form select:focus{
            background:rgba(13, 17, 23, 0.9);
            border:none;
            opacity:0.5;
        }
        .dateNTime{
            width:100%;
            display:flex;
            justify-content:space-between;
        }
        .dateNTimeFlex{
            display:flex;
            width:60%;
            flex-direction:column;
        }
        .dateNTime label{
            width:100%;
            color:#9CA3AF;
        }
        .dateNTime select{
            width:100%;
        }
        .buttons{
            display:flex;
            justify-content:center;
        }
        .buttons input{
            margin:20px 10px;
            width:200px;
            text-align:center;
            border-radius:0 20px 0 20px;
        }
        .buttons input:hover{
            background:var(--blue);
            color:black;
            font-weight:700;
        }
        .genders{
            display:flex;
            justify-content:center;
        }
        .genderSelect{
            display:flex;
            align-items:center;
            margin:0 20px;
        }
        .gender input{
            box-shadow:none;
        }
        .gender label{
            margin:0 8px;
            color:white;
        }
        .gender h5{
            text-align:center;
            color:white;
            margin-top:20px;
        }
    </style>
</head>
<body>
<?php

// Genrate QR Code using StudentID

if(isset($_POST['submit'])){

    include "../phpqrcode/qrlib.php";
    $PNG_TEMP_DIR = 'temp/';

    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    $filename = $PNG_TEMP_DIR . $QRID.'.png';

    if(isset($_POST['submit'])){
        $codeString = $_POST['sId'];

        $filename = $PNG_TEMP_DIR . $QRID .
        md5($codeString).'.png';

        QRcode::png($codeString,$filename);

        echo '
        <div id="qrRemove">
            <img src="' . $PNG_TEMP_DIR .
            basename($filename) . '"/>
            <div class="QRDownloaded">
                <h2>Your QR code was download successfully !</h2>
                <ion-icon name="download-outline"></ion-icon>
            </div>    
        </div>
        ';
    }
}

?>
    <div class="register">
        <h1>Register Students to Get QR Code</h1>
        <form name="registerForm" method="POST">
            <input type="text" id="sName" name="sName" placeholder="Student Name">
            <div class="inputFlex">
                <input class="inputWidth" type="text" name="sId" placeholder="Student Id">
                <input style="padding-right:170px" class="inputWidth" type="date" name="birthday">
            </div>
            <input type="text" name="address" placeholder="Address">
            <div class="inputFlex">
                <input class="inputWidth" type="text" name="pNumber" placeholder="Phone Number(Parents)">
                <input class="inputWidth" type="text" name="wNumber" placeholder="Whatsapp Number">
            </div>
            <div class="inputFlex">
                <input style="width:68%" type="text" name="email" placeholder="Email">
                <input style="width:28%" type="text" name="cProjects" placeholder="Completed Projects">
            </div>
    
            <!-- Select Date and Time Fields -->
    
            <div class="dateNTime">
                <div class="dateNTimeFlex">
                    <label for="selectDate1">Select Date 01 :</label>
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
                </div>
        
                <div id="timeSelection1">
                    <div class="dateNTimeFlex">
                        <label for="selectTime">Select Your Time :</label>
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
                </div>
            </div>
    
            <!-- Select Date and Time Fields -->
    
            <div class="dateNTime">
                <div class="dateNTimeFlex">
                    <label for="selectDate2">Select Date 02 :</label>
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
                </div>
        
                <div id="timeSelection2">
                    <div class="dateNTimeFlex">
                        <label for="selectTime">Select Your Time :</label>
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
                </div>
            </div>
    
            <!-- Select Date and Time Fields -->
    
            <div class="dateNTime">
                <div class="dateNTimeFlex">
                    <label for="selectDate3">Select Date 03 :</label>
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
                </div>
        
                <div id="timeSelection3">
                    <div class="dateNTimeFlex">
                        <label for="selectTime">Select Your Time :</label>
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
                </div>
            </div>

            <div class="gender">
                <h5>Gender</h5>
                <div class="genders">
                    <div class="genderSelect">
                        <label for="male">Male</label>
                        <input id="male" type="radio" name="gender" value="1">
                    </div>
                    <div class="genderSelect">
                        <label for="female">Female</label>
                        <input id="female" type="radio" name="gender" value="0">
                    </div>
                </div>
                
            </div>

            <select name="cName" id="campusName">
                <option value="0">Select Your DP IT Campus</option>
                <option value="28">DP IT Campus Hathagala</option>
                <option value="29">DP IT Campus Udhdhakandara</option>
                <option value="30">DP IT Campus Tangalle</option>
                <option value="31">DP IT Campus Ambalanthota</option>
                <option value="32">DP IT Campus Embilipitiya</option>
            </select>

            <div class="buttons">
                <input type="submit" value="Register" name="submit">
                <input type="reset" value="Reset Form">
            </div>
    
        </form>
    </div>


    </div>
</div>

    <script>
        // Show time when select date
        function showTimeSelection1() {
            var selectDate1 = document.getElementById("selectDate1");
            var timeSelection1 = document.getElementById("timeSelection1");

            // Check if a valid date is selected
            if (selectDate1.value !== "0") {
                timeSelection1.style.display = "flex";
            } else {
                timeSelection1.style.display = "none";
            }
        }

        function showTimeSelection2() {
            var selectDate2 = document.getElementById("selectDate2");
            var timeSelection2 = document.getElementById("timeSelection2");

            // Check if a valid date is selected
            if (selectDate2.value !== "0") {
                timeSelection2.style.display = "flex";
            } else {
                timeSelection2.style.display = "none";
            }
        }

        function showTimeSelection3() {
            var selectDate3 = document.getElementById("selectDate3");
            var timeSelection3 = document.getElementById("timeSelection3");

            // Check if a valid date is selected
            if (selectDate3.value !== "0") {
                timeSelection3.style.display = "flex";
            } else {
                timeSelection3.style.display = "none";
            }
        }

        // Remove QR after 5 seconds
        document.addEventListener('DOMContentLoaded',function(){
            var qrRemove = document.getElementById('qrRemove');

            if(qrRemove){
                setTimeout(function(){
                    qrRemove.remove();
                }, 5000);
            }
        })
    </script>

</body>
</html>