<?php
    session_start();
    
    $redirectURL = "";

if(!isset($_SESSION['name'])){
    $redirectURL = '../login.php';
}elseif(!isset($_GET['studentId'])){
    echo "Invalid URL. Please Contact Admin";
}else{
    $studentId = $_GET['studentId'];

    // Database Operations
    include "../db_connection.php";

    try{

        $updateActivness = $db->prepare("UPDATE `students` SET `IsActive`=? WHERE `StudentID`=?");
        $updateActivness->execute(array('1',$studentId));

        if($updateActivness->rowCount()>0){
            $_SESSION['reenroll'] = "Student Re-enrolled Successfully";
            $redirectURL = 'removed.php';
            header("location:$redirectURL");
            exit();
        }
    }catch(PDOException $e){
        die("ERROR: Coult not able to execute $updateActivness.".$e->getMessage());
    }

}

?>