<?php

    session_start();

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }


try{
    // Connct Database
    include "../db_connection.php";
    
    $check = $db->prepare("UPDATE `students` SET `IsActive`=0 WHERE`AttendanceStatus`=?");
    $check->execute(array('00000'));
    $affectedRows = $check->rowCount();

    $_SESSION['check'] = $affectedRows;

    header("location:dashboard.php?checked=$affectedRows");

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>