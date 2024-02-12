<?php 
    $page_id=10;
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

        /* Toast Notifications */

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        .notifications{
         font-family: 'Poppins', sans-serif;
         position: fixed;
         top: 30px;
         right: 20px;
        }
        .toast{
            position: relative;
            padding: 10px;
            color: #fff;
            margin-bottom: 10px;
            width: 400px;
            display: grid;
            grid-template-columns: 70px 1fr 70px;
            border-radius: 5px;
            --color: #0abf30;
            background-image: 
                linear-gradient(
                    to right, #0abf3055, #22242f 30%
                ); 
            animation: show 0.3s ease 1 forwards  
        }
        .toast i{
            color: var(--color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: x-large;
        }
        .toast .title{
            font-size: x-large;
            font-weight: bold;
        }
        .toast span, .toast i:nth-child(3){
            color: #fff;
            opacity: 0.6;
        }
        @keyframes show{
            0%{
                transform: translateX(100%);
            }
            40%{
                transform: translateX(-5%);
            }
            80%{
                transform: translateX(0%);
            }
            100%{
                transform: translateX(-10%);
            }
        }
        .toast::before{
            position: absolute;
            bottom: 0;
            left: 0;
            background-color: var(--color);
            width: 100%;
            height: 3px;
            content: '';
            box-shadow: 0 0 10px var(--color);
            animation: timeOut 5s linear 1 forwards
        }
        @keyframes timeOut{
            to{
                width: 0;
            }
        }
        .toast.error{
            --color: #f24d4c;
            background-image: 
                linear-gradient(
                    to right, #f24d4c55, #22242F 30%
                );
        }
        .toast.warning{
            --color: #e9bd0c;
            background-image: 
                linear-gradient(
                    to right, #e9bd0c55, #22242F 30%
                );
        }
        .toast.info{
            --color: #3498db;
            background-image: 
                linear-gradient(
                    to right, #3498db55, #22242F 30%
                );
        }

    </style>
</head>
<body>

    <?php

    // Variable Declaration
    $pwdMsg5="";
    $pwdMsg6="";
    $pwdMsg7="";
    $pwdMsg8="";
    $pwdMsg9="";
    $pwdMsg10="";
    $pwdUpdate="";

    try{

        include "../db_connection.php";
    
        if(isset($_POST['reset'])){

            // Password Validation
            if(!empty($_POST['cPwd']) && !empty($_POST['nPwd'] && !empty($_POST['cNPwd']))){
                if($_POST['nPwd'] === $_POST['cNPwd']){
                    $pwd = $db->prepare("SELECT `Password` FROM `admins` WHERE `Username`=?");
                    $pwd ->execute(array($_SESSION['name']));

                    if($pwd->rowCount()>0){
                        $result = $pwd->fetch();

                        // Old Password Verification
                        if(password_verify($_POST['cPwd'],$result['Password'])){
                            $update=$db->prepare("UPDATE `admins` SET `Password`=? WHERE `Username`=?");
                            $update->execute(array(password_hash($_POST['nPwd'],PASSWORD_DEFAULT,),$_SESSION['name']));
                        
                            if($update->rowCount()>0){
                                $pwdUpdate = "Password changed successfully";
                            }else{
                                $pwdMsg9 =  $update->errorInfo()[2];
                            }
                        }else{
                            $pwdMsg8 = "Your current password is wrong";
                        }
                    }else{
                        $pwdMsg7 = "Error Selecting username related to password! Please contact admin";
                    }
                }else{
                    $pwdMsg6 = "New Passwords do not match";
                }
            }else{
                $pwdMsg5 = "Current Password and New Passwords are required";
            }
        }
    }catch (PDOException $e){
        $pwdMsg10 = $e->getMessage();
    }

    // Create div for toast animation
    if(!empty($pwdMsg5)){
        echo "<div id='pwdMsg5'></div>";
    }
    if(!empty($pwdMsg6)){
        echo "<div id='pwdMsg6'></div>";
    }
    if(!empty($pwdMsg7)){
        echo "<div id='pwdMsg7'></div>";
    }
    if(!empty($pwdMsg8)){
        echo "<div id='pwdMsg8'></div>";
    }
    if(!empty($pwdMsg9)){
        echo "<div id='pwdMsg9'></div>";
    }
    if(!empty($pwdMsg10)){
        echo "<div id='pwdMsg10'></div>";
    }
    if(!empty($pwdUpdate)){
        echo "<div id='pwdUpdate'></div>";
    }

    ?>

    <section class="row">
        <h1>Change Your Password</h1>
        <form method="POST">
            <input type="password" name="cPwd" placeholder="Current Password">
            <input type="password" name="nPwd" placeholder="New Password">
            <input type="password" name="cNPwd" placeholder="Confirm New Password">
            <input class="buttons" type="submit" name="reset" value="Reset Password">
        </form>
    </section>

    <div class="notifications"></div>

    <script src="../app.js"></script>
    </div>
</div>
</body>
</html>