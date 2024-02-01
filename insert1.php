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

        $_SESSION['QR'] = $text;

        $sql = $db->prepare("SELECT * FROM `daily_users` WHERE `StudentID`=? AND `LOGDATE`=? AND `Status`=?");
        $sql->execute(array($text,$date,'0'));
        if($sql->rowCount()>0){
            $sql = $db->prepare("UPDATE `daily_users` SET `TimeOut`=?, `Status`=? WHERE `StudentID`=? AND `LogDate`=?");
            $sql-> execute(array($time,'1',$text,$date));
            $_SESSION['timeOut'] = 'Successfully Time Out';
        }else{
            // Check scanned student IsActive
            $isActive = $db->prepare("SELECT * FROM `students` WHERE `StudentID`=? AND `IsActive`=?");
            $isActive ->execute(array($text,'1'));

            if($isActive->rowCount()>0){

                // Insert data to daily_users table
                $sql = $db->prepare("INSERT INTO `daily_users`(`StudentID`,`TimeIn`,`LogDate`,`Status`) VALUES(?,?,?,?)");
                $sql->execute(array($text,$time,$date,'0'));
                if($sql->rowCount()>0){
                    $_SESSION['timeIn'] = 'Successfully Time In';
                }else{
                    $_SESSION['error'] = $db->error;
                }
    
                // Update AttendaceStatus of students table
                $attendanceUpdate = $db->prepare("UPDATE `students` SET `AttendanceStatus`=	
                                                        CASE 
                                                            WHEN LENGTH(`AttendanceStatus`) =5 THEN CONCAT(SUBSTRING(`AttendanceStatus`,2), 1)
                                                            ELSE CONCAT(`AttendanceStatus`, 1)
                                                        END
                                                    WHERE `StudentID`=?");                                            
                $attendanceUpdate -> execute(array($text));
    
                // Delete detail from the daily_time_tables
                $deleteDetails = $db->prepare("DELETE FROM `daily_time_tables` WHERE `StudentID`=?");
                $deleteDetails -> execute(array($text));

            }else{
                $_SESSION['warning'] = "You are not attended 5 days in a row. Please Contact admin to reregister";
            }

        }

        unset($_POST['text']);

    }else{
        $_SESSION['qrNotSet'] = 'Please Scan Your QR Code Number';
    }

    header("location: index.php");
    exit();
    $db = null;

    // Insert Attendance Student Data to Database <---End--->

?>