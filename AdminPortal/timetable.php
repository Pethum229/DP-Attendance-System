<?php

$currentDate = date('Y-m-d');
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

// Set 5.30 AM - 7.30 AM Student List
echo "<h1>$currentDayName 5.30AM - 7.30AM Student List ($currentDate)</h1>";

$timeTable01 = $day.'1';

try{
    include_once "../db_connection.php";

    $timeTable = $db->prepare("INSERT INTO `daily_time_tables` (`StudentID`,`DateNTime`) SELECT `StudentID`,`DateAndTime` FROM `time_tables` WHERE `DataAndTime`=? ORDER BY `Count` ASC LIMIT 25");
    $timeTable -> execute(array($timeTable01));

}


?>