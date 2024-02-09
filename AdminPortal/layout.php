<?php include "../inc_header.php"; ?>
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
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="all.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">All Students</span>
                    </a>
                </li>
                <li>
                    <a href="add.php">
                        <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                        <span class="title">Add New Students</span>
                    </a>
                </li>
                <li>
                    <a href="daily_attendance.php">
                        <span class="icon"><ion-icon name="today-outline"></ion-icon></span>
                        <span class="title">Today Students</span>
                    </a>
                </li>
                <li>
                    <a href="removed.php">
                        <span class="icon"><ion-icon name="person-remove-outline"></ion-icon></ion-icon></span>
                        <span class="title">Removed Students</span>
                    </a>
                </li>
                <li>
                    <a href="summary.php">
                        <span class="icon"><ion-icon name="analytics-outline"></ion-icon></span>
                        <span class="title">Analytics</span>
                    </a>
                </li>
                <li>
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
                        <a href="check.php">
                            <span class="icon"><ion-icon name="checkmark-done-outline"></ion-icon></span>
                            <span class="title">Check Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="timetable.php">
                            <span class="icon"><ion-icon name="hourglass-outline"></ion-icon></span>
                            <span class="title">Make Time Table</span>
                        </a>
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

                    // echo $currentHour;
                ?>


                <!-- UserImg -->
                <div class="user">
                    <h4>Hi, <?php echo $welcome ?></h4>
                    <h4><?php echo $_SESSION['name'] ?></h4>
                </div>
            </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="layout.js"></script>

