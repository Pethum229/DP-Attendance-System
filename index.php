<?php include "inc_header.php"; ?>
    <title>DP Attendance System</title>
    <style>
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
        }
        .scanner{
            width:100%;
        }
        .student{
            width:100%;
            display:flex;
            justify-content:center;
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
        
        @keyframes glowing {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }
    </style>
</head>
<body>
    <!-- Structure of Camera Preview and Input Boxes <-Start-> -->

    <section class="wrapper">
        <div>
            <h1 class="heading">Student Attendance System</h1>
        </div>
        <div class="time">
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
        <div class="w-100">
            <button id="startScanButton" class="btn-scan">Hover Me! Then click me to Start Scan <img src="images/icons8-qr-code-ezgif.com-gif-maker.gif"></button>
        </div>
        <div class="scanner">
            <video id="preview"></video>
            <?php
                // unset($_SESSION['success']);
                // unset($_SESSION['error']);
                if(isset($_SESSION['error'])){
                    echo"
                        <div id='error' class='alert alert-danger'>
                            <h4>Error!</h4>
                            ".$_SESSION['error']."
                        </div>
                    ";
                }
                if(isset($_SESSION['success'])){
                    echo"
                        <div id='success' class='alert alert-success' style='background:green; color:white;'>
                            <h4>Success!</h4>
                            ".$_SESSION['success']."
                        </div>
                    ";
                }
            ?>
        </div>
        <div class="student">
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
                <div>
                    <h2>Last Scanned Student Details</h2>
                </div>
                <div class="detailList">
                    <ol>
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
                <div>
                    <h3>
                        Happy Learning!
                    </h3>
                </div>
                <?php
                }};
                ?>
            </div>
        </div>
    </section>

    <!-- Structure of Camera Preview and Input Boxes <-End-> -->

    <script>
        // Read the QR Code <---Start--->=
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        // Get the button element
        let startScanButton = document.getElementById('startScanButton');
        // Add an event listener to the button
        startScanButton.addEventListener('click', function() {
            startScanButton.style.display = 'none';
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
            
        // Set the scanned content to the input field
        document.getElementById('text').value = content;
            
        // Submit the form
        document.forms[0].submit();
            
    });

        // Read the QR Code <---End--->


        // Set Timeout for massages <---Start--->

        setTimeout(function(){

            <?php
            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }

            if(isset($_SESSION['success'])){
                unset($_SESSION['success']);
            }
            ?>
            
        },4000);

        // Set Timeout for massages <---End--->


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

    </script>
</body>
</html>
