<?php include "inc_header.php"; ?>
    <title>Login</title>
</head>
<body>
    <form name="login" method="POST">
        <input type="text" name="aName" placeholder="Username" >
        <input type="password" name="aPwd" placeholder="Password" >
        <input type="submit" value="Login" name="submit">
    </form>

    <?php

try{  
    // connect to db
    include "db_connection.php";

    // Check for registered user
    $check = $db->prepare("SELECT * FROM `admins` WHERE `Username`=?");
    $check ->execute(array($_POST['aName']));

    if ($check->rowCount()>0){
        if ($result = $check->fetch()){
            // Password Verification
            if (password_verify($_POST['aPwd'],$result['Password'])){
                // Set session variables
                $_SESSION['id']= $result['Username'];

                echo "Successfully loggedin";

                // Redirect to homepage
                header("location:AdminPortal/dashboard.php");
            }

        }
    }
    
}catch (PDOException $e){
    $msg.=$e->getMessage();
}

    ?>
</body>
</html>