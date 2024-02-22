<?php
    session_start();
    
    $redirectURL = "";

if(!isset($_SESSION['name'])){
    $redirectURL = '../login.php';
    echo "Clicked";
}elseif(!isset($_GET['studentId'])){
    echo "Invalid URL. Please Contact Admin";
}else{
    $studentId = $_GET['studentId'];

    // Database Operations
    include "../db_connection.php";

    try{

        $updateActivness = $db->prepare("UPDATE `students` SET `IsActive`=? WHERE `StudentID`=?");
        $updateActivness->execute(array('0',$studentId));

        if($updateActivness->rowCount()>0){
            $_SESSION['delete'] = "Record Deleted Successfully";
            $redirectURL = 'all.php';
            header("location:$redirectURL");
            exit();
        }
    }catch(PDOException $e){
        die("ERROR: Coult not able to execute $updateActivness.".$e->getMessage());
    }

}

?>