<?php
$page_id=3;
include "layout.php";

if(!isset($_SESSION['name'])){
    header("location:../login.php");
    exit();
}


if (isset($_POST['submit'])){  
    
    $QRID = $_POST['sId'];

    // Varaible Declaration
    $nameMsg1="";
    $sIdMsg1="";
    $sIdMsg2="";
    $sIdMsg3="";
    $birthdayMsg1="";
    $birthdayMsg2="";
    $birthdayMsg3="";
    $addressMsg1="";
    $numberMsg1="";
    $numberMsg2="";
    $numberMsg3="";
    $numberMsg4="";
    $numberMsg5="";
    $emailMsg7="";
    $emailMsg8="";
    $emailMsg9="";
    $emailMsg10="";
    $projectMsg1="";
    $projectMsg2="";
    $projectMsg3="";
    $dateMsg01="";
    $dateMsg02="";
    $dateMsg03="";
    $timeMsg1="";
    $timeMsg2="";
    $genderMsg01="";
    $campusMsg01="";
    $registerSuccess = "";
    $dbErr1="";

    // Form Validation
    // Student Name Validation
    if(empty($_POST['sName'])) $nameMsg1="Student Name is Required";

    // StudentID Validation
    if(empty($_POST['sId'])) $sIdMsg1="Student ID is required";
    elseif(strlen($_POST['sId'])>=8) $sIdMsg2="Student ID must be shorter than 8 characters";

    // Birthday Validation
    $birthday = $_POST['birthday'];

    if(empty($birthday)) $birthdayMsg1="Birthday is required";
    else{
        $dateObj = DateTime::createFromFormat('Y-m-d',$birthday);

        if(!$dateObj){
            $birthdayMsg2 = "Invalid birthday format. Please use mm/dd/yyyy";
        }else{
            $year = $dateObj->format('Y');
            if(strlen($year) !==4){
                $birthdayMsg3 = "Invalid year format. Year must have exactly 4 characters";
            }
        }
    }

    // Address Validation
    if(empty($_POST['address'])) $addressMsg1 = "Address is required";

    //Phone Number Validation
    if(empty($_POST['pNumber'])) $numberMsg1 = "Phone number is required";
    elseif(!is_numeric($_POST['pNumber'])) $numberMsg2 = "Phone number must be contain numbers";
    elseif(strlen($_POST['pNumber']) != 10) $numberMsg3 = "Phone number must have 10 numbers. Please use 07XXXXXXXX format";

    // Whatsapp Number Validation
    if(!is_numeric($_POST['wNumber'])) $numberMsg4 = "Whatsapp number must be contain numbers";
    elseif(strlen($_POST['wNumber']) != 10) $numberMsg5 = "Whatsapp number must have 10 numbers. Please use 07XXXXXXXX format";

    // Email Validation
    if(!empty($_POST['email'])){
        $_POST['email'] = trim($_POST['email']);
        if (empty($_POST['email'])) $emailMsg8 = "Your email is still empty. Please type your email correctly";
        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $emailMsg9 = "Email address is not valid";
    }else{
        $emailMsg7 = "Email is required";
    }

    // Completed Projects Validation
    if(empty($_POST['cProjects']) && $_POST['cProjects'] !=0) $projectMsg1 = "Completed project count is required";
    elseif(!is_numeric($_POST['cProjects'])) $projectMsg2 = "Project count must be a number";
    elseif($_POST['cProjects'] >= 321) $projectMsg3 = "Please enter valid project count";

    // Date Validation

    if(empty($_POST['date01'])) $dateMsg01 = "Day 01 is required";
    elseif($_POST['date01'] == $_POST['date02'] || $_POST['date01'] == $_POST['date03'] || $_POST['date02'] == $_POST['date03']) $dateMsg02 = "Please select different 03 days";
    elseif($_POST['date01'] == '0') $dateMsg03 = "Please Choose Day 01";

    if(empty($_POST['time01'])) $timeMsg1 = "Time 01 is required";
    elseif($_POST['time01'] == '0') $timeMsg2 = "Please Choose Time 01";

    // Gender Validation
    if(empty($_POST['gender'])) $genderMsg01 = "Gender is required";

    // Campus Validation
    if(empty($_POST['cName']) || $_POST['cName']=='0') $campusMsg01 = "Please choose your campus";

    // Database Operations
    if(empty($nameMsg1) && empty($sIdMsg1) && empty($sIdMsg2) && empty($birthdayMsg1) && empty($birthdayMsg2) && empty($birthdayMsg3) && empty($addressMsg1) && empty($numberMsg1) && empty($numberMsg2) && empty($numberMsg3) && empty($numberMsg4) && empty($numberMsg5) && empty($emailMsg7) && empty($emailMsg8) && empty($emailMsg9) && empty($projectMsg1) && empty($projectMsg2) && empty($projectMsg3) && empty($dateMsg01) && empty($dateMsg02) && empty($dateMsg03) && empty($timeMsg1) && empty($timeMsg2) && empty($genderMsg01) && empty($campusMsg01)){

        try{
            include "../db_connection.php";

            // Check StudentId is already registerd
            $checksId = $db->prepare("SELECT `StudentID` FROM `students` WHERE `StudentID`=?");
            $checksId->execute(array($_POST['sId']));

            // Check email is already registerd
            $checkEmail = $db->prepare("SELECT `Email` FROM `students` WHERE `Email`=?");
            $checkEmail->execute(array($_POST['email']));

            if ($checksId->rowCount()>0) $sIdMsg3 = "Your Student ID is already registered";
            elseif ($checkEmail->rowCount()>0) $emailMsg10 = "Your Email is already registered";
            else{

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
            
                $registerSuccess = "Student registered successfully";

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
            
                // echo "Date added successfully!";

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
            }
        
        
        }catch(PDOException $e){
            $dbErr1=$e->getMessage();
        }

    }

    // Create div for toast animation and javascript
    if($nameMsg1 != ""){
        echo "<div id='nameMsg1'><div>";
    }
    if($sIdMsg1 != ""){
        echo "<div id='sIdMsg1'><div>";
    }
    if($sIdMsg2 != ""){
        echo "<div id='sIdMsg2'><div>";
    }
    if($sIdMsg3 != ""){
        echo "<div id='sIdMsg3'><div>";
    }
    if($birthdayMsg1 != ""){
        echo "<div id='birthdayMsg1'><div>";
    }
    if($birthdayMsg2 != ""){
        echo "<div id='birthdayMsg2'><div>";
    }
    if($birthdayMsg3 != ""){
        echo "<div id='birthdayMsg3'><div>";
    }
    if($addressMsg1 != ""){
        echo "<div id='addressMsg1'><div>";
    }
    if($numberMsg1 != ""){
        echo "<div id='numberMsg1'><div>";
    }
    if($numberMsg2 != ""){
        echo "<div id='numberMsg2'><div>";
    }
    if($numberMsg3 != ""){
        echo "<div id='numberMsg3'><div>";
    }
    if($numberMsg4 != ""){
        echo "<div id='numberMsg4'><div>";
    }
    if($numberMsg5 != ""){
        echo "<div id='numberMsg5'><div>";
    }
    if($emailMsg7 != ""){
        echo "<div id='emailMsg7'><div>";
    }
    if($emailMsg8 != ""){
        echo "<div id='emailMsg8'><div>";
    }
    if($emailMsg9 != ""){
        echo "<div id='emailMsg9'><div>";
    }
    if($emailMsg10 != ""){
        echo "<div id='emailMsg10'><div>";
    }
    if($projectMsg1 != ""){
        echo "<div id='projectMsg1'><div>";
    }
    if($projectMsg2 != ""){
        echo "<div id='projectMsg2'><div>";
    }
    if($projectMsg3 != ""){
        echo "<div id='projectMsg3'><div>";
    }
    if($dateMsg01 != ""){
        echo "<div id='dateMsg01'><div>";
    }
    if($dateMsg02 != ""){
        echo "<div id='dateMsg02'><div>";
    }
    if($dateMsg03 != ""){
        echo "<div id='dateMsg03'><div>";
    }
    if($timeMsg1 != ""){
        echo "<div id='timeMsg1'><div>";
    }
    if($timeMsg2 != ""){
        echo "<div id='timeMsg2'><div>";
    }
    if($genderMsg01 != ""){
        echo "<div id='genderMsg01'><div>";
    }
    if($campusMsg01 != ""){
        echo "<div id='campusMsg01'><div>";
    }
    if($registerSuccess != ""){
        echo "<div id='registerSuccess'><div>";
    }
    if($dbErr1 != ""){
        echo "<div id='dbErr1'><div>";
    }


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


        /* Toast Notification */

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
</head>
<body>
    <div class="register">
        <h1>Register Students to Get QR Code</h1>
        <form name="registerForm" method="POST">
            <input type="text" id="sName" required name="sName" placeholder="Student Name" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['sName']; ?>">
            <div class="inputFlex">
                <input class="inputWidth" type="text" required name="sId" placeholder="Student Id" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['sId']; ?>" >
                <input style="padding-right:170px" required class="inputWidth" type="date" name="birthday" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['birthday']; ?>">
            </div>
            <input type="text" name="address" required placeholder="Address" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['address']; ?>">
            <div class="inputFlex">
                <input class="inputWidth" type="text" required name="pNumber" placeholder="Phone Number(Parents)"  value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['pNumber']; ?>">
                <input class="inputWidth" type="text" name="wNumber" placeholder="Whatsapp Number" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['wNumber']; ?>">
            </div>
            <div class="inputFlex">
                <input style="width:68%" type="text" required name="email" placeholder="Email"  value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['email']; ?>">
                <input style="width:28%" type="text" name="cProjects" placeholder="Completed Projects" value = "<?php if(isset($_POST['submit']) && empty($registerSuccess)) echo $_POST['cProjects']; ?>">
            </div>
    
            <!-- Select Date and Time Fields -->
    
            <div class="dateNTime">
                <div class="dateNTimeFlex">
                    <label for="selectDate1">Select Date 01 :</label>
                    <select required name="date01" id="selectDate1" onchange="showTimeSelection1()">
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
                        <select required name="time01" id="selectTime">
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
                        <input required id="male" type="radio" name="gender" value="1">
                    </div>
                    <div class="genderSelect">
                        <label for="female">Female</label>
                        <input required id="female" type="radio" name="gender" value="0">
                    </div>
                </div>
                
            </div>

            <select required name="cName" id="campusName">
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

    <div class="notifications"></div>
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
    <script src="../app.js"></script>

</body>
</html>