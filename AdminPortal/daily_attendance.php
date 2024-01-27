<?php include "../inc_header.php"; ?>
    <title>Daily Attendance | Admin Portal of DP Attendance System</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        header{
            width:80%;
            margin:0 auto;
            background:#fffff0;
            float:right;
        }
        section{
            margin:0 auto;
        }
        .logo{
            width:150px;
            height:150px
        }
    </style>
</head>
<body>
    <header>
        <div>
            <p>Hi! Pethum,</p>
            <img class="logo" src="../images/OIP.jpg" alt="Logo">
        </div>
    </header>
    <section class="container">
        <div class="row">
            <!-- Structre of Daily Loggedin Student Table <-Start-> -->
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Student ID</td>
                            <td>Time In</td>
                            <td>Time Out</td>
                            <td>Log Date</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../db_connection.php";
                            
                            $date = date('Y-m-d');

                            // $sql = "SELECT ID,StudentID,TimeIn FROM daily_users";
                            $sql = $db->prepare("SELECT `ID`,`StudentID`,`TimeIn`,`TimeOut`,`LogDate`,`Status` FROM `daily_users` WHERE `LogDate`=?");
                            $sql->execute(array($date));
                            while ($row = $sql -> fetch (PDO::FETCH_ASSOC)){      
                        ?>
                            <tr>
                                <td><?php echo $row['ID'] ?></td>
                                <td><?php echo $row['StudentID'] ?></td>

                                <td><?php echo $row['TimeIn'] ?></td>
                                <td><?php echo $row['TimeOut'] ?></td>
                                <td><?php echo $row['LogDate'] ?></td>
                                <td><?php echo $row['Status'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success pull-right" onclick="Export()">
                    <i class="fa fa-file-excel-o fa-fw">Export to Excel</i>
                </button>
                <!-- Structre of Daily Loggedin Student Table <-End-> -->
        </div>
    </section>

    <script>
        function Export(){
            var conf = confirm("Please confirm if you wish to proced in exporting the attendance in to Excel File");
            if(conf==true){
                window.open("../export.php",'_blank');
            }
        }
    </script>
</body>
</html>