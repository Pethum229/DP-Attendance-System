<?php
    include "db_connection.php";

    $filename ='AllStudents-'.date('Y-m-d').'.csv';

    $query = $db->prepare("SELECT * FROM `students` WHERE `IsActive`=?");
    $query->execute(array('1'));
    $result = $query->fetchAll();

    $array = array();

    $file = fopen($filename,"w");
    $array = array("ID","Student ID","Student Name","Address","Phone Number","Whatsapp Number","Birthday","Email","Projects Completed","Gender","Register Date");
    fputcsv($file,$array);

    foreach($result as $row){
        $ID = $row['Id'];
        $StudentID = $row['StudentID'];
        $StudentName = $row['StudentName'];
        $Address = $row['Address'];
        $PhoneNumber = $row['PhoneNumber'];
        $WhatsappNumber = $row['WhatsappNumber'];
        $Birthday = $row['Birthday'];
        $Email = $row['Email'];
        $ProjectsCompleted = $row['ProjectsCompleted'];
        $Gender = $row['Gender'];
        $RegDate = $row['RegDate'];

        $array = array($ID,$StudentID,$StudentName,$Address,$PhoneNumber,$WhatsappNumber,$Birthday,$Email,$ProjectsCompleted,$Gender,$RegDate);
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