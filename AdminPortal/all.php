<?php include "../inc_header.php"; ?>
    <title>All Students</title>
    <style>
        .buttonIcons{
            width:20px;
            height:20px;
        }
    </style>
</head>
<body>
<section class="container">
        <div class="row">
            <!-- Structre of  Students Table <-Start-> -->
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Student ID</td>
                            <td>Student Name</td>
                            <td>Phone Number</td>
                            <td>Projects Completed</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../db_connection.php";

                            $sql = $db->prepare("SELECT `ID`,`StudentID`,`StudentName`,`PhoneNumber`,`ProjectsCompleted` FROM `students` WHERE `IsActive`=?");
                            $sql->execute(array('1'));
                            while ($row = $sql -> fetch (PDO::FETCH_ASSOC)){      
                        ?>
                            <tr>
                                <td><?php echo $row['ID'] ?></td>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['StudentName'] ?></td>
                                <td><?php echo $row['PhoneNumber'] ?></td>
                                <td><?php echo $row['ProjectsCompleted'] ?></td>
                                <td>
                                    <a href=""><img class="buttonIcons" src="../images/view-eye-interface-symbol.png" alt="View Button"></a>
                                    <a href=""><img class="buttonIcons" src="../images/edit-button.png" alt="Edit Button"></a>
                                    <a href=""><img class="buttonIcons" src="../images/delete-button.png" alt="Delete Button"></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success pull-right" onclick="Export()">
                    <i class="fa fa-file-excel-o fa-fw">Export to Excel</i>
                </button>
                <!-- Structre of Student Table <-End-> -->
        </div>
    </section>

    <script>
        function Export(){
            var conf = confirm("Please confirm if you wish to proced in exporting the attendance in to Excel File");
            if(conf==true){
                window.open("../export1.php",'_blank');
            }
        }
    </script>
</body>
</html>