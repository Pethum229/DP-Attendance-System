<?php 

    include "layout.php"; 

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }

?>
    <title>Not Attended Students</title>
    <style>
        .filters{
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:rgba(13, 17, 23, 0.9);
            padding:10px 5px;
            margin-bottom:20px;
            border-radius:10px;
        }
        .filters select{
            background:transparent;
            border:none;
            border-bottom:1px solid gray;
            color:gray;
            padding-bottom:3px;
        }
        .filters select:focus{
            background:rgba(13, 17, 23, 0.9);
            border:none;
            opacity:0.5;
        }
        .filters input{
            margin-left:20px;
            background:transparent;
            border:none;
            border-bottom:1px solid gray;
            text-align:center;
            padding-bottom:3px;
        }
        .buttonIcons{
            width:20px;
            height:20px;
        }
        .row{
            background:#11161d;
            margin:20px;
            padding: 20px 40px;
            border-radius:20px;
        }
        table thead td{
            background:var(--blue);
            color:black;
            font-weight:600;
        }
        table thead td ion-icon{
            vertical-align:text-top;
        }
        table thead td ion-icon:hover{
            color:white;
        }
        table tbody td{
            color:var(--white);
        }
        tbody tr:nth-child(even){
            background-color: black; 
        }
        tbody tr:nth-child(odd){
            background-color: rgba(13, 17, 23, 0.4); 
        }
        .row tbody a ion-icon{
            font-size:18px;
            text-align:center;
            margin:0 3px;
        }
        .row thead td:last-child{
            text-align:center;
        }
        .actions{
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .actions ion-icon:hover{
            color:white !important;
        }
        .exportBtn{
            background-color: #2d3748;
            padding: 5px 10px;
            border:none;
            border-radius: 0px 8px 0px 8px;
            color: var(--white);
            text-decoration: none;
        }
        .exportBtn:hover{
            background-color: transparent;
            border: 1px solid var(--blue);
            color: var(--blue);
        }
        .actions a{
            text-decoration:none;
        }
        .btnEnroll{
            background:green;
            color:black;
            padding:5px 15px;
            border-radius:5px;
            margin-left:10px;
        }
        .btnEnroll:hover{
            background:transparent;
            color:white;
            border:2px solid var(--blue);
        }
        .filterBtn:hover{
            background:var(--blue);
            color:black !important;
        }
    </style>
</head>
<body>
    <section>
        <div class="row">
            <div class="filters">
                <form>
                    <select name="" id="rows">
                        <option value="0">Select Row Count</option>
                        <option value="1">5</option>
                        <option value="2">10</option>
                        <option value="3">25</option>
                        <option value="4">50</option>
                        <option value="5">100</option>
                    </select>
                    <input type="text" placeholder="Search by Name or ID">
                    <input style="border:1px solid white; padding:2px 15px; color:white;" class="filterBtn" type="submit" value="Filter">
                </form>
                <button type="submit" class="exportBtn" onclick="Export()">
                    Export
                    <ion-icon name="download-outline"></ion-icon>
                </button>
            </div>
            <!-- Structre of  Removed Students Table <-Start-> -->
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID<ion-icon id="id" name="arrow-up-outline"></ion-icon></td>
                            <td>Student ID<ion-icon id="sId" name="arrow-up-outline"></ion-icon></td>
                            <td>Student Name<ion-icon id="sName" name="arrow-up-outline"></ion-icon></td>
                            <td>Phone Number</td>
                            <td>Projects Completed<ion-icon id="pCompleted" name="arrow-up-outline"></ion-icon></td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../db_connection.php";

                            $sql = $db->prepare("SELECT `ID`,`StudentID`,`StudentName`,`PhoneNumber`,`ProjectsCompleted` FROM `students` WHERE `IsActive`=?");
                            $sql->execute(array('0'));
                            while ($row = $sql -> fetch (PDO::FETCH_ASSOC)){      
                        ?>
                            <tr>
                                <td><?php echo $row['ID'] ?></td>
                                <td><?php echo $row['StudentID'] ?></td>
                                <td><?php echo $row['StudentName'] ?></td>
                                <td><?php echo $row['PhoneNumber'] ?></td>
                                <td><?php echo $row['ProjectsCompleted'] ?></td>
                                <td class="actions">
                                    <a href=""><ion-icon name="eye-outline"></ion-icon></a>
                                    <a class="btnEnroll" href="#">Re-Enroll</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Structre of Removed Student Table <-End-> -->
        </div>
    </section>
    </div>
</div>

    <script>
        function Export(){
            var conf = confirm("Please confirm if you wish to proced in exporting the attendance in to Excel File");
            if(conf==true){
                window.open("../export2.php",'_blank');
            }
        }

        // Change arrow
        // Function to toggle ion-icon name attribute
        function toggleIcon(iconId) {
            var ionIcon = document.getElementById(iconId);

            if (ionIcon.getAttribute('name') === 'arrow-up-outline') {
                ionIcon.setAttribute('name', 'arrow-down-outline');
            } else {
                ionIcon.setAttribute('name', 'arrow-up-outline');
            }
        }

        // Add click event listeners to each ion-icon
        document.getElementById('id').addEventListener('click', function() {
            toggleIcon('id');
        });

        document.getElementById('sId').addEventListener('click', function() {
            toggleIcon('sId');
        });

        document.getElementById('sName').addEventListener('click', function() {
            toggleIcon('sName');
        });

        document.getElementById('pCompleted').addEventListener('click', function() {
            toggleIcon('pCompleted');
        });
    </script>
</body>
</html>
</body>
</html>