<?php 

    include "layout.php";

    if(!isset($_SESSION['name'])){
        header("location:../login.php");
        exit();
    }

?>
    <title>Settings</title>
    <style>
        .row{
            margin:20px;
            background:#11161d;
            padding:20px;
            border-radius:20px;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .row h1{
            font-family:var(--roboto);
            text-align:center;
            color:var(--blue);
            margin-bottom:20px;
        }
        form{
            display:flex;
            flex-direction:column;
            align-items:center;
            width:70%;
        }
        form input{
            background:transparent;
            border:none;
            color:var(--white);
            margin:10px 0;
            padding:5px 10px 5px 10px;
            box-shadow:0 1px 5px rgb(0 231 255 / 22%);
            border-radius:10px;
            height:40px;
            width:100%;
        }
        form input::placeholder{
            color:#fff;
        }
        .buttons{
            margin:20px 10px;
            width:200px;
            text-align:center;
            border-radius:0 20px 0 20px;
            margin:20px 0;
        }
        .buttons:hover{
            background:var(--blue);
            color:black;
            font-weight:700;
        }
    </style>
</head>
<body>

    <?php

    include "../db_connection.php";

    if(isset($_POST['reset'])){
        $pwd = $db->prepare("SELECT `Password` FROM `admins` WHERE `Username`=?");
        $pwd ->execute(array($_SESSION['name']));

        if($pwd->rowCount()>0){
            $result = $pwd->fetch();

            // Old Password Verification
            if(password_verify($_POST['cPwd'],$result['Password'])){
                $update=$db->prepare("UPDATE `admins` SET `Password`=? WHERE `Username`=?");
                $update->execute(array(password_hash($_POST['nPwd'],PASSWORD_DEFAULT,),$_SESSION['name']));

                if($update->rowCount()>0){
                    echo "Password Updated Successfully";
                }else{
                    echo "Error Updating Password" . $update->errorInfo()[2];
                }
            }
        }
    }

    ?>

    <section class="row">
        <h1>Change Your Password</h1>
        <form method="POST">
            <input type="text" name="cPwd" placeholder="Current Password">
            <input type="text" name="nPwd" placeholder="New Password">
            <input type="text" name="cNPwd" placeholder="Confirm New Password">
            <input class="buttons" type="submit" name="reset" value="Reset Password">
        </form>
    </section>


    </div>
</div>
</body>
</html>