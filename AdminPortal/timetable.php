<?php

$currentDayName = date('l');
// echo $currentDayName;

switch($currentDayName){
    case "Sunday":
        $day = "1";
        break;
    case "Monday":
        $day = "2";
        break;
    case "Tuesday":
        $day = "3";
        break;
    case "Wednesday":
        $day = "4";
        break;     
    case "Thursday":
        $day = "5";
        break;
    case "Friday":
        $day = "6";
        break;
    case "Saturday":
        $day = "7";
        break;   
}

$timeTable01 = $day.'1';
$timeTable02 = $day.'2';
$timeTable03 = $day.'3';
$timeTable04 = $day.'4';
$timeTable05 = $day.'5';
$timeTable06 = $day.'6';
$timeTable07 = $day.'7';
$timeTable08 = $day.'8';


try{
    include_once "../db_connection.php";

    // Delete all rows of daily_time_table
    $deleteAllRows = $db->prepare("DELETE FROM `daily_time_tables`");
    $deleteAllRows -> execute();

    // Insert selected data from time_tables table to daily_time_table
    $timeTable = $db->prepare("INSERT INTO `daily_time_tables` (`StudentID`,`DateNTime`)
                                    SELECT tt.`StudentID`,
                                           tt.`DateAndTime` FROM `time_tables` tt 
                                            JOIN `students` s ON tt.`StudentID` = s.`StudentID`
                                                WHERE tt.`DateAndTime`=? AND s.`IsActive`=? ORDER BY tt.`Count` ASC LIMIT 30");

    // Insert 01 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable01,'1'));

    // Insert 02 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable02,'1'));

    // Insert 03 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable03,'1'));

    // Insert 04 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable04,'1'));

    // Insert 05 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable05,'1'));

    // Insert 06 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable06,'1'));

    // Insert 07 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable07,'1'));

    // Insert 08 time slot data to daily_time_table
    $timeTable -> execute(array($timeTable08,'1'));

    echo "Daily time table was created successfully";

    //Update count of time_tables
    $countUpdate = $db->prepare("UPDATE `time_tables` tt JOIN `daily_time_tables` dt
                                                                ON tt.`StudentID` = dt.`StudentID` AND tt.`DateAndTime` = dt.`DateNTime`
                                                                    SET tt.`Count` = tt.`Count`+1");
    $countUpdate -> execute();

    echo "Time table count updated successfully";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


?>