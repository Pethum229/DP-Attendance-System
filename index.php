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
                    if(isset($_SESSION['error'])){
                        echo"
                            <div class='alert alert-danger'>
                                <h4>Error!</h4>
                                ".$_SESSION['error']."
                            </div>
                        ";
                    }

                    if(isset($_SESSION['success'])){
                        echo"
                            <div class='alert alert-success' style='background:green; color:white;'>
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
                
                <div>
                    <h2>Student Details</h2>
                </div>
                <div>
                    <ol>
                        <li>Student ID : </li>
                        <li>Student Name : </li>
                        <li>Address : </li>
                        <li>Contact Number : </li>
                        <li>Whatsapp Number : </li>
                        <li>Birthday : </li>
                        <li>Email : </li>
                        <li>Projects Completed : </li>
                    </ol>
                </div>
                <div>
                    <h3>
                        Happy Learning!
                    </h3>
                </div>
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
            
        // Optionally, you can restart the scanner after some time if needed
        //setTimeout(function() {
        //    scanner.start();
        //}, 3000);  // Adjust the delay as needed (e.g., 3000 milliseconds)
    });

        // Read the QR Code <---End--->
    </script>
</body>
</html>
