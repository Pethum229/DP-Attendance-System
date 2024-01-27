<?php

try{
    // Connct Database
    include "../db_connection.php";
    
    $check = $db->prepare("UPDATE `students` SET `IsActive`=0 WHERE`AttendanceStatus`=?");
    $check->execute(array('00000'));
    $affectedRows = $check->rowCount();

    echo "Updated $affectedRows rows successfully";

    header("location:dashboard.php?checked=$affectedRows");

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>