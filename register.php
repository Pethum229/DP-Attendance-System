<?php include "inc_header.php"; ?>
    <title>Register</title>
</head>
<body>
    <form name="register" method="POST">
        <input type="text" name="aName" placeholder="Username">
        <select name="cName" id="campusName">
            <option value="0">Select Your DP IT Campus</option>
            <option value="28">DP IT Campus Hathagala</option>
            <option value="29">DP IT Campus Udhdhakandara</option>
            <option value="30">DP IT Campus Tangalle</option>
            <option value="31">DP IT Campus Ambalanthota</option>
            <option value="32">DP IT Campus Embilipitiya</option>
        </select>
        <input type="password" name="aPwd" placeholder="New Password">
        <input type="password" placeholder="Confirm New Password">
        <div>
            <input type="submit" value="Register" name="submit">
            <input type="reset" value="Reset Form">
        </div>
    </form>

    <?php

    include "db_connection.php";

    $pwd= password_hash($_POST['aPwd'],PASSWORD_DEFAULT);

    $adminInsert = $db->prepare("INSERT INTO `admins` (`CampusId`,`Username`,`Password`)
                                        VALUES (?,?,?)")->execute(array($_POST['cName'],$_POST['aName'],$pwd));
    
    echo "Admin registered successfully";

    if($adminInsert){
        header("location:login.php");
    }

    ?>
</body>
</html>