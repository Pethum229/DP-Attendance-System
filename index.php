<?php include "inc_header.php"; ?>
    <title>DP Attendance System</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        .container{
            width:1200px;
            margin:0 auto;
        }
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

    <section class="container">
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
                    <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonly="" placeholder="Scan QR Code" class="form-control">
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

    </script>
</body>
</html>
