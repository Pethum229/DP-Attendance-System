<?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password="11111";
    $dbname="dp_attendence_system";

    $conn = new mysqli($server,$username,$password,$dbname);

    // Insert Attendance Student Data to Database <---Start--->

    if($conn->connect_error){
        die("Connection_failed" .$conn->connect_error);
    }

    if(isset($_POST['text'])){
        $text = $_POST['text'];
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $sql = "SELECT * FROM daily_users WHERE StudentID='$text' AND LOGDATE='$date' AND Status='0'";
        $query=$conn->query($sql);
        if($query->num_rows>0){
            $sql = "UPDATE daily_users SET TimeOut='$time', Status='1' WHERE StudentID='$text' AND LogDate='$date'";
            $query=$conn->query($sql);
            $_SESSION['success'] = 'Successfuly Time Out';
        }else{
            $sql = "INSERT INTO daily_users(StudentID,TimeIn,LogDate,Status) VALUES('$text','$time','$date','0')";
            if($conn->query($sql) === TRUE){
                $_SESSION['success'] = 'Successfuly Time In';
            }else{
                $_SESSION['error'] = $conn->error;
            }
        }
    }else{
        $_SESSION['error'] = 'Please Scan Your QR Code Number';
    }

    header("location: index.php");
    exit();
    $conn->close();

    // Insert Attendance Student Data to Database <---End--->

?>