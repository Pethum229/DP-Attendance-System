<?php include "layout.php"; ?>
<title>Anlytics | Admin Portal</title>
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    .anlytics{
        background:#11161d;
        margin:20px;
        padding: 20px 40px;
        border-radius:20px;
        width:100%;
    }
    .buttons{
        display:flex;
        justify-content:space-between;
        margin-bottom:30px;
    }
    .buttons a{
        text-decoration:none;
        font-size:16px;
        background:black;
        padding:10px 20px;
        border-radius:15px 15px 0 0;
    }

</style>
</head>
<body>
    <section>
        <!-- Charts -->
        <div class="anlytics">
            <div class="buttons">
                <a href="attendance_overview.php">Attendance Overview</a>
                <a href="time_table_overview.php">Time Table Overview</a>
                <a href="new_student_overview.php">New Students Overview</a>
                <a href="summary.php">Summary</a>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>