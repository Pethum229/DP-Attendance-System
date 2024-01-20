<?php
    session_start();
    include "db_connection.php";

    // Insert Attendance Student Data to Database <---Start--->

    // Set your desired timezone
    date_default_timezone_set('Asia/Kolkata');

    if(isset($_POST['text'])){
        $text = $_POST['text'];
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $sql = $db->prepare("SELECT * FROM `daily_users` WHERE `StudentID`=? AND `LOGDATE`=? AND `Status`=?");
        $sql->execute(array($text,$date,'0'));
        if($sql->rowCount()>0){
            $sql = $db->prepare("UPDATE `daily_users` SET `TimeOut`=?, `Status`=? WHERE `StudentID`=? AND `LogDate`=?");
            $sql-> execute(array($time,'1',$text,$date));
            $_SESSION['success'] = 'Successfuly Time Out';
        }else{
            $sql = $db->prepare("INSERT INTO `daily_users`(`StudentID`,`TimeIn`,`LogDate`,`Status`) VALUES(?,?,?,?)");
            $sql->execute(array($text,$time,$date,'0'));
            if($sql->rowCount()>0){
                $_SESSION['success'] = 'Successfuly Time In';
            }else{
                $_SESSION['error'] = $db->error;
            }
        }
    }else{
        $_SESSION['error'] = 'Please Scan Your QR Code Number';
    }

    header("location: index.php");
    exit();
    $db = null;

    // Insert Attendance Student Data to Database <---End--->

?>