<?php

    session_start();

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }

    include "db_connection.php";

    $filename ='AttendanceRecord-'.date('Y-m-d').'.csv';

    $query = $db->prepare("SELECT * FROM `daily_users`");
    $query->execute(array());
    $result = $query->fetchAll();

    $array = array();

    $file = fopen($filename,"w");
    $array = array("ID","Student ID","Completed Projects (Today)","Time In","Time Out","Log Date","Status");
    fputcsv($file,$array);

    foreach($result as $row){
        $ID = $row['ID'];
        $StudentID = $row['StudentID'];
        $CompletedProjects = $row['CompletedProjects'];
        $TimeIn = $row['TimeIn'];
        $TimeOut = $row['TimeOut'];
        $LogDate = $row['LogDate'];
        $Status = $row['Status'];

        $array = array($ID,$StudentID,$CompletedProjects,$TimeIn,$TimeOut,$LogDate,$Status);
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