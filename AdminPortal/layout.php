<?php 

include "../inc_header.php";

// Debugging: Output session variables to check their values
var_dump($_SESSION['button_clicked_date']);
var_dump($_SESSION['button_disabled']);

if(!isset($_SESSION['name'])){
    header("location:../login.php");
    exit();
}

// Check if the button was clicked today
$buttonClickedToday = isset($_SESSION['button_clicked_date']) && $_SESSION['button_clicked_date'] === date('Y-m-d');

// Check if the button should be disabled
$buttonDisabled = isset($_SESSION['button_disabled']) && $_SESSION['button_disabled'];

// Debugging: Output the current date to see if it matches with the stored date
echo "Current Date: " . date('Y-m-d');

// Debugging: Output the button state variables
echo "Button Clicked Today: " . ($buttonClickedToday ? 'Yes' : 'No');
echo "Button Disabled: " . ($buttonDisabled ? 'Yes' : 'No');

// Check if the button should be clickable
$buttonClickable = !$buttonClickedToday || ($buttonClickedToday && !$buttonDisabled);

// Reset button state if a new day has started
if (!$buttonClickedToday) {
    $_SESSION['button_disabled'] = false;
}

// Handle button click
if (isset($_POST['click_button'])) {
    // Perform actions when the button is clicked
    // For example, update database, perform some operation, etc.
    
    // Set button clicked date
    $_SESSION['button_clicked_date'] = date('Y-m-d');
    // Disable the button until the next day
    $_SESSION['button_disabled'] = true;
    // Redirect to prevent multiple form submissions
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

?>

    <title>Admin Portal</title>
    <link rel="stylesheet" href="layout.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="laptop-outline"></ion-icon></span>
                        <span class="title">DP Attendance System</span>
                    </a>
                </li>
                <li class="<?php if($page_id==1) echo 'hovered'; ?>">
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="<?php if($page_id==2) echo 'hovered'; ?>">
                    <a href="all.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">All Students</span>
                    </a>
                </li>
                <li class="<?php if($page_id==3) echo 'hovered'; ?>">
                    <a href="add.php">
                        <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                        <span class="title">Add New Students</span>
                    </a>
                </li>
                <li class="<?php if($page_id==4) echo 'hovered'; ?>">
                    <a href="daily_attendance.php">
                        <span class="icon"><ion-icon name="today-outline"></ion-icon></span>
                        <span class="title">Today Students</span>
                    </a>
                </li>
                <li class="<?php if($page_id==5) echo 'hovered'; ?>">
                    <a href="removed.php">
                        <span class="icon"><ion-icon name="person-remove-outline"></ion-icon></ion-icon></span>
                        <span class="title">Removed Students</span>
                    </a>
                </li>
                <li class="<?php if($page_id==6 || $page_id==7 || $page_id==8 ||$page_id==9) echo 'hovered'; ?>">
                    <a href="summary.php">
                        <span class="icon"><ion-icon name="analytics-outline"></ion-icon></span>
                        <span class="title">Analytics</span>
                    </a>
                </li>
                <li class="<?php if($page_id==10) echo 'hovered'; ?>">
                    <a href="setting.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main -->

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <!-- Search -->
                <div class="search">
                    <li>
                        <button class="btn-top">
                            <a href="check.php">
                                <span class="icon"><ion-icon name="checkmark-done-outline"></ion-icon></span>
                                <span class="title">Check Students</span>
                            </a>
                        </button>
                    </li>
                    <li>
                        <form method="POST">
                            <button class="btn-top" id="clickableButton">
                                <a <?php if (!$buttonClickable) echo 'style="pointer-events: none; cursor: default;"'; ?> href="<?php echo ($buttonClickable) ? 'timetable.php' : 'javascript:void(0)'; ?>">
                                    <span class="icon"><ion-icon name="hourglass-outline"></ion-icon></span>
                                    <span class="title">Make Time Table</span>
                                </a>
                            </button>
                            <input type="hidden" name="click_button" value="1">
                        </form>
                    </li>
                </div>
                 
                <!-- Set Time -->

                <?php

                    date_default_timezone_set('Asia/Colombo');
                    $currentHour = date('G');

                    if ($currentHour >= 0 && $currentHour < 12) {
                        // Between 00:00 and 11:59
                        $welcome = "Good Morning";

                    } elseif ($currentHour >= 12 && $currentHour < 16) {
                        // Between 12:00 and 15:59
                        $welcome = "Good Afternoon";
                    } elseif ($currentHour >= 16 && $currentHour < 19) {
                        // Between 16:00 and 18:59
                        $welcome = "Good Evening";
                    } else {
                        // Between 19:00 and 23:59
                        $welcome = "Good Night";
                    }

                ?>

                <!-- UserImg -->
                <div class="user">
                    <h4>Hi, <?php echo $welcome ?></h4>
                    <h4><?php echo $_SESSION['name']; ?></h4>
                </div>
            </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="layout.js"></script>

