<?php include "inc_header.php"; ?>
    <title>DP Attendance System</title>
    <style>
        .blur {
            filter: blur(5px); /* Adjust the blur intensity as needed */
            overflow: hidden; /* Prevent scrolling when blurred */
        }
        #preview{
            width:100%;
            height:300px;
        }
        .w-100{
            width:100%;
            display:flex;
            justify-content:center;
        }
        .time{
            display:flex;
            justify-content:center;
            margin-bottom:20px;
        }
        .timeContent{
            border:3px solid var(--border);
            border-radius:5px;
            padding:10px 0;
            width:800px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .scanner{
            width:100%;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .student{
            width:100%;
            display:flex;
            justify-content:center;
            margin-top:20px;
        }
        .heading{
            font:var(--roboto);
            font-size:40px;
            color:var(--accent);
            font-weight:bold;
            text-align:center;
            text-transform:uppercase;
            margin:20px 0;
        }
        .timeContent>h2{
            color:var(--white);
            font:var(--actor);
            font-size:35px;
            text-align:center;
        }
        .date{
            color:var(--white);
            font:var(--actor);
            text-align:center;
            font-size:25px;
        }
        #current-time{
            text-align:center;
            color:var(--white);
            font-family:var(--roboto);
            font-size:40px;
            margin-top:-20px;
        }
        .detailList{
            display:flex;
            justify-content:center;
            margin-top:15px;
        }
        .scanDetails{
            background:var(--glassy);
            padding:10px 20px;
            border-radius:10px;
            border:2px solid red;
            animation: borderAnimation 5s infinite;
        }
        .titleSD{
            color:var(--white);
            font-family:var(--roboto);
            font-size:30px;
        }
        #inputProjects{
            display:flex;
            flex-direction:column;
            align-items:center;
            margin-top:20px;
            /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
            padding:15px 20px;
        }
        #inputProjects>label{
            font-family:var(--actor);
            color:var(--text);
            font-size:20px;
        }
        #cProjects{
            width:250px;
            font-family:var(--actor);
            color:var(--placeholder);
            background:var(--input);
            border: none;
            height: 30px;
            padding-left: 10px;
            font-size: 15px;
            border-radius: 10px 0 0 0;
        }
        #cProjects:active{
            border:2px solid var(--border);
        }
        .submitBtn{
            color:var(--white);
            font-family:var(--actor);
            font-size:18px;
            margin-left: 1px;
            background: var(--input);
            border: none;
            height: 30px;
            padding: 0 10px;
            border-radius: 0 0 10px 0;
            text-transform:uppercase;
        }
        .submitBtn:hover{
            background:black;
            color:white;
        }
        .details>li{
            color:var(--text);
        }
        .btn-scan>img{
            width:25px;
            height:25px;
        }
        /* .btn-scan{
            color:var(--white);
            background:var(--button);
            border:none;
            padding:20px;
            border-radius:50px;
            position:absolute;
            top:120px;
            left:120px;
            font:var(--roboto);
            font-size:24px;
        } */
        .btn-scan {
            font:var(--roboto);
            font-size:24px;
            padding:10px 20px;
            text-align:center;
            border: none;
            outline: none;
            color: #fff;
            /* background: var(--border); */
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
        }
        .btn-scan:before {
            content: '';
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            position: absolute;
            top: -2px;
            left:-2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing 20s linear infinite;
            opacity: 0;
            transition: opacity .3s ease-in-out;
            border-radius: 10px;
        }
        
        .btn-scan:active {
            color: #000
        }
        
        .btn-scan:active:after {
            background: transparent;
        }
        
        .btn-scan:hover:before {
            opacity: 1;
        }
        
        .btn-scan:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--glassy);
            left: 0;
            top: 0;
            border-radius: 10px;
        }
        .popup{
            position:absolute;
            top:-150%;
            left:50%;
            opacity:0;
            transform:translate(-50%,-50%) scale(1.25);
            width:460px;
            padding:20px 30px;
            background:var(--popup);
            box-shadow:2px 2px 5px 5px rgba(0,0,0,0.15);
            border-radius:10px;
            transition:top 0ms ease-in-out 200ms,
                       opacity 200ms ease-in-out 0ms,
                       transform 200ms ease-in-out 0ms;
        }
        .popup.active{
            top:50%;
            opacity:1;
            transform:translate(-50%,-50%) scale(1);
            transition:top 0ms ease-in-out 0ms,
                       opacity 200ms ease-in-out 0ms,
                       transform 200ms ease-in-out 0ms;
        }
        .popup .close-btn{
            position:absolute;
            top:10px;
            right:10px;
            width:15px;
            height:15px;
            background:#888;
            color:#eee;
            text-align:center;
            line-height:15px;
            border-radius:15px;
            cursor:pointer;
        }
        
        @keyframes glowing {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }

        @keyframes borderAnimation {
            0% {
                border-color: red;
            }
            25% {
                border-color: blue;
            }
            50% {
                border-color: green;
            }
            75% {
                border-color: yellow;
            }
            100% {
                border-color: red;
            }
        }

        /* Check Start */

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        body{
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1C1D22;
        }
        button{
            padding: 10px;
        }
        .notifications{
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

        /* Check End */
    </style>
</head>
<body>
    <!-- Unset already setted sessions <-Start->-->
    <?php
    // Check if any of the specified session variables is set
    if (
        isset($_SESSION['error']) ||
        isset($_SESSION['timeIn']) ||
        (isset($_SESSION['timeOut']) && isset($_POST['submit']))||
        isset($_SESSION['warning']) ||
        isset($_SESSION['qrNotSet'])
    ) {
        // Set a timeout in JavaScript to trigger an AJAX request after 5 seconds
        echo "<script>
                setTimeout(function() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('GET', 'unset_session.php', true);
                    xhttp.send();
                }, 5000);
              </script>";
    }
    ?>
    <!-- Unset already setted sessions <-End->-->

    <?php

    if(isset($_POST['submit'])){

        $studentID = $_SESSION['QR'];
        $cProjects = $_POST['cProjects'];

        include_once "db_connection.php";

        //Update 'CompletedProjects' in daily_users table
        $updateDailyUsers = $db->prepare("UPDATE `daily_users` SET `CompletedProjects`=? WHERE `StudentID`=? ORDER BY ID DESC LIMIT 1");
        $updateDailyUsers->execute(array($cProjects,$studentID));

        //Update 'CompletedProjects' in students table
        $updateStudents = $db->prepare("UPDATE `students` SET `ProjectsCompleted` = `ProjectsCompleted`+? WHERE `StudentID`=?");
        $updateStudents->execute(array($cProjects,$studentID));

    }

    ?>


    <!-- Structure of Camera Preview and Input Boxes <-Start-> -->

    <section class="wrapper">
        <div id="title">
            <h1 class="heading">Student Attendance System</h1>
        </div>
        <div id="time" class="time">
            <div class="timeContent">
                <h2>Scan Your QR Code</h2>

                <?php

                    date_default_timezone_set('Asia/Kolkata');

                    $currentDate = date('Y-m-d');
                    $currentDay = date('l');

                    echo "<h4 class='date'>$currentDay".', '."$currentDate</h4><br>";

                ?>

                <div id="current-time"></div>

            </div>
        </div>
        <div id="btnSS" class="w-100">
            <button id="startScanButton" class="btn-scan">Hover Me! Then click me to Start Scan <img src="images/icons8-qr-code.gif"></button>
        </div>
        
        <div class="student" id="student">
            <div class="sDetails">
                <form action="insert1.php" method="POST" class="form-horizontal">
                    <input type="text" name="text" id="text" readonly="" placeholder="Scan QR Code" class="form-control" style="display:none">
                </form>
                
                <?php
                include_once "db_connection.php";
                if(isset($_SESSION['QR'])){
                    $sDetails = $db->prepare("SELECT `StudentID`,
                                                    `StudentName`,
                                                    `Address`,
                                                    `PhoneNumber`,
                                                    `WhatsappNumber`,
                                                    `Birthday`,
                                                    `Email`,
                                                    `ProjectsCompleted` FROM `students` WHERE `StudentID`=?");
                    $sDetails->execute(array($_SESSION['QR']));
                    while ($row = $sDetails -> fetch (PDO::FETCH_ASSOC)){
                    
                ?>
                <div class="scanDetails">
                    <div>
                        <h2 class="titleSD">Last Scanned Student Details</h2>
                    </div>
                    <div class="detailList">
                        <ol class="details">
                            <li>Student ID : <?php echo $row['StudentID'] ?></li>
                            <li>Student Name : <?php echo $row['StudentName'] ?></li>
                            <li>Address : <?php echo $row['Address'] ?></li>
                            <li>Contact Number : <?php echo $row['PhoneNumber'] ?></li>
                            <li>Whatsapp Number : <?php echo $row['WhatsappNumber'] ?></li>
                            <li>Birthday : <?php echo $row['Birthday'] ?></li>
                            <li>Email : <?php echo $row['Email'] ?></li>
                            <li>Projects Completed : <?php echo $row['ProjectsCompleted'] ?></li>
                        </ol>
                    </div>
                </div>
                <?php
                }};
                ?>
            </div>
        </div>

        <div class="scanner">
            <?php
                // unset($_SESSION['success']);
                // unset($_SESSION['error']);
                if(isset($_SESSION['error'])){
                    echo"
                        <div id='error'></div>
                    ";
                }
                if(isset($_SESSION['timeIn'])){
                    echo"
                        <div id='timeIn'></div>
                    ";
                }
                if(isset($_SESSION['timeOut'])){
                    if(!isset($_POST['submit'])){
                        echo"
                            <div class='popup'>
                                <form name='inputProjects' id='inputProjects' method='POST'>
                                    <label for='cProjects'>How many project completed you today ?</label>
                                    <div class='inputRow'>
                                        <input id='cProjects' name='cProjects' type='text' placeholder='Projects Count'>
                                        <input class='submitBtn' type='submit' id='subPro' name='submit' value='Submit'>
                                    </div>
                                </form>
                            </div>
                        ";
                    }

                    // Visible timeOut Div
                    if(isset($_POST['submit'])){
                        echo"
                            <div id='timeOut'></div>
                        ";

                        unset($_POST['submit']);

                        // header("location:index.php");
                    }

                }
                if(isset($_SESSION['warning'])){
                    echo"
                        <div id='warning'></div>
                    ";
                }
                if(isset($_SESSION['qrNotSet'])){
                    echo"
                        <div id='qrNotSet'></div>
                    ";
                }
            ?>
            <video id="preview"></video>
        </div>
    </section>

    <div class="notifications"></div>

    <!-- Structure of Camera Preview and Input Boxes <-End-> -->

    <script>
        // Read the QR Code <---Start--->=
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        // Get the button element
        let startScanButton = document.getElementById('startScanButton');
        // Get the student details div
        let studentDetails = document.getElementById('student');
        // Add an event listener to the button
        startScanButton.addEventListener('click', function() {
            startScanButton.style.display = 'none';
            studentDetails.style.display = 'none';
            Instascan.Camera.getCameras().then(function(cameras){
                if(cameras.length > 0){
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e){
                console.error(e);
            });
        });

        scanner.addListener('scan', function(content) {
        // Stop the scanner after a QR code is scanned
        scanner.stop();
        startScanButton.style.display = 'inline-block';
        studentDetails.style.display = 'block';
            
        // Set the scanned content to the input field
        document.getElementById('text').value = content;
            
        // Submit the form
        document.forms[0].submit();
            
    });

        // Read the QR Code <---End--->

        // Update time every second <---Start--->

        function getCurrentTime() {
            // Make an AJAX request to get_current_time.php using fetch
            fetch('get_current_time.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.text();
                })
                .then(data => {
                    // Update the content of the "current-time" div with the response
                    document.getElementById("current-time").innerHTML = data;
                })
                .catch(error => {
                    console.error('Error during fetch operation:', error);
                });
        }

        // Call getCurrentTime initially to display the current time
        getCurrentTime();

        // Update the time every second
        setInterval(getCurrentTime, 1000);


        // Update time every second <---End--->


        // Popup <---Start--->

        document.addEventListener('DOMContentLoaded', function () {
            var popupElement = document.querySelector('.popup');

            var title = document.getElementById('title');
            var time = document.getElementById('time');
            var btnSS = document.getElementById('btnSS');
            var student = document.getElementById('student');
        
            if (popupElement) {
                popupElement.classList.add('active');
                title.classList.add('blur');
                time.classList.add('blur');
                btnSS.classList.add('blur');
                student.classList.add('blur');
            } else {
                console.log('Popup Element is not loaded yet.');
            }

            document.getElementById('subPro').addEventListner("click",function(){
                title.classList.remove('blur');
                time.classList.remove('blur');
                btnSS.classList.remove('blur');
                student.classList.remove('blur');
            });
        });

        // Popup <---End--->

    </script>

    <script src="app.js"></script>

</body>
</html>
