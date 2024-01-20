<?php
    include "db_connection.php";

    $filename ='AttendanceRecord-'.date('Y-m-d').'.csv';

    $query = "SELECT * FROM daily_users";
    $result = mysqli_query($conn,$query);

    $array = array();

    $file = fopen($filename,"w");
    $array = array("ID","Student ID","Time In","Time Out","Log Date","Status");
    fputcsv($file,$array);

    while($row = mysqli_fetch_array($result)){
        $ID = $row['ID'];
        $StudentID = $row['StudentID'];
        $TimeIn = $row['TimeIn'];
        $TimeOut = $row['TimeOut'];
        $LogDate = $row['LogDate'];
        $Status = $row['Status'];

        $array = array($ID,$StudentID,$TimeIn,$TimeOut,$LogDate,$Status);
        fputcsv($file,$array);
    }
    fclose($file);

    header("Content-Description: File Transfer");
    header("Content-Disposition: Attachment; filename=$filename");
    header("Content-type: application/csv;");
    readfile($filename);
    unlink($filename);
    exit();
?>