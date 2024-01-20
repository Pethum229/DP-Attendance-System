<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DP Attendance System</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <!-- Structure of Camera Preview and Input Boxes <-Start-> -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
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
            <div class="col-md-6">
                <form action="insert1.php" method="POST" class="form-horizontal">
                    <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonly="" placeholder="Scan QR Code" class="form-control">
                </form>

                <!-- Structre of Daily Loggedin Student Table <-Start-> -->

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Student ID</td>
                            <td>Time In</td>
                            <td>Time Out</td>
                            <td>Log Date</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $server = "localhost";
                            $username = "root";
                            $password="11111";
                            $dbname="dp_attendence_system";
                        
                            $conn = new mysqli($server,$username,$password,$dbname);
                        
                            if($conn->connect_error){
                                die("Connection_failed" .$conn->connect_error);
                            }
                            
                            // $sql = "SELECT ID,StudentID,TimeIn FROM daily_users";
                            $sql = "SELECT ID,StudentID,TimeIn,TimeOut,LogDate,Status FROM daily_users WHERE DATE(TimeIn)=CURDATE()";
                            $query = $conn->query($sql);
                            while ($row = $query->fetch_assoc()){      
                        ?>
                            <tr>
                                <td><?php echo $row['ID'] ?></td>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['TimeIn'] ?></td>
                                <td><?php echo $row['TimeOut'] ?></td>
                                <td><?php echo $row['LogDate'] ?></td>
                                <td><?php echo $row['Status'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Structre of Daily Loggedin Student Table <-End-> -->

            </div>
        </div>
    </div>

    <!-- Structure of Camera Preview and Input Boxes <-End-> -->

    <script>
        // Read the QR Code <---Start--->

        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan', function(content){
            document.getElementById('text').value = content;
            document.forms[0].submit();
        });

        // Read the QR Code <---End--->
    </script>
</body>
</html>
