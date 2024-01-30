<?php include "inc_header.php"; ?>
    <title>DP Attendance System</title>
    <style>
        .row{
            display:flex;
        }
        #preview{
            width:100%
        }
        .scanner{
            width:50%;
        }
        .student{
            width:50%;
        }
    </style>
</head>
<body>
    <!-- Structure of Camera Preview and Input Boxes <-Start-> -->

    <section class="wrapper">
        <div>
            <h1>Student Attendance System</h1>
        </div>
        <div class="time">
            <div class="timeContent">
                <h2>Scan Your QR Code</h2>

                <?php

                    date_default_timezone_set('Asia/Kolkata');

                    $currentDate = date('Y-m-d');
                    $currentDay = date('l');

                    echo "$currentDay".','."$currentDate <br>";

                ?>

                <div id="current-time"></div>

            </div>
        </div>
        <div class="row">
            <div class="scanner">
                <video id="preview"></video>
                <button id="startScanButton" class="btn btn-primary">Start Scan</button>
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
                    <h2>Student Details</h2>
                </div>
                <div>
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
