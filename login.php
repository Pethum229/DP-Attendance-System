<?php include "inc_header.php"; ?>
    <title>Login</title>
    <link rel="stylesheet" href="toast.css">
    <style>
    body {
      background-color: #0d1117; /* Adjust the background color */
      color: #c9d1d9;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Form Container */
    section {
      background-color: rgba(13, 17, 23, 0.9);
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 199, 199, 0.7);
    }

    .login>h1{
        font-family:var(--actor);
        text-transform:uppercase;
        text-align:center;
        margin-bottom:10px;
        font-size:45px;
    }
    .login{
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:20px;
    }
    .login>i{
        font-size:50px;
        margin-left:20px;
    }

    /* Form Inputs */
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      background-color: #2d3748;
      color: #c9d1d9;
      border: 1px solid #4b5563;
      border-radius: 5px;
    }

    /* Submit Button */
    input[type="submit"] {
      background: linear-gradient(to right, #00c7c7, #00555f);
      color: #ffffff;
      cursor: pointer;
      transition: transform 0.2s ease-in-out;
    }

    input[type="submit"]:hover {
      transform: scale(1.05);
    }

    /* Placeholder Text Color */
    ::placeholder {
      color: #9CA3AF;
    }

    .footer{
        display:flex;
        justify-content:space-between;
    }

    </style>
</head>
<body>

    <?php
        if(isset($_GET['registered'])){
            echo "<div id='resgisterSuccess'></div>";
        }elseif(isset($_GET['loggedout'])){
            echo "<div id='loggedout'></div>";
        }
    ?>

    <section>
        <div class="login">
            <h1>Login</h1>
            <i class="fa-solid fa-right-to-bracket"></i>
        </div>
        <form name="login" method="POST">
            <input type="text" name="aEmail" placeholder="Email">
            <input type="password" name="aPwd" placeholder="Password">
            <input type="submit" value="Login" name="submit">
        </form>
        <div class="footer">
            <p>You haven't account ? <a href="register.php">Register</a></p>
            <a id="forgotPwd" href="#">Forgot Password</a>
        </div>
    </section>

    <div class="notifications"></div>

    <?php

    // Define Variables
    $emailMsg4="";
    $emailMsg5="";
    $emailMsg6="";
    $pwdMsg3="";
    $pwdMsg4="";
    $err2="";
        
    if(isset($_POST['submit'])){
        // Email Validation
        $_POST['aEmail'] = trim($_POST['aEmail']);
        if(empty($_POST['aEmail'])) $emailMsg4 = "Email cannot be empty";
        elseif(!filter_var($_POST['aEmail'],FILTER_VALIDATE_EMAIL)) $emailMsg5 = "Email address is not valid";
    
        // Passwords Validation
        if(empty($_POST['aPwd'])) $pwdMsg3 = "Password cannot be empty";
    
        // DB Operations
        if($emailMsg4=="" && $pwdMsg3==""){
            try{  
                // connect to db
                include "db_connection.php";
            
                // Check for registered user
                $check = $db->prepare("SELECT * FROM `admins` WHERE `Email`=?");
                $check ->execute(array($_POST['aEmail']));
            
                if ($check->rowCount()>0){
                    if ($result = $check->fetch()){
                        // Password Verification
                        if (password_verify($_POST['aPwd'],$result['Password'])){
                            // Set session variables
                            $_SESSION['name']= $result['Username'];
                            // $_SESSION['id']=$result['CampusId'];
                        
                            // Redirect to homepage
                            header("location:AdminPortal/dashboard.php?loggedin=1");
                        
                        }else $pwdMsg4 = "Password you entered is incorrect";
                    }
                }else $emailMsg6 = "Email address you entered is not registered";
            
            }catch (PDOException $e){
                $err2=$e->getMessage();
            }
        }
    
        // Create div for toast animation and javascript
        if($emailMsg4 != ""){
            echo "<div id='emailMsg4'><div>";
        }
        if($emailMsg5 != ""){
            echo "<div id='emailMsg5'><div>";
        }
        if($emailMsg6 != ""){
            echo "<div id='emailMsg6'><div>";
        }
        if($pwdMsg3 != ""){
            echo "<div id='pwdMsg3'><div>";
        }
        if($pwdMsg4 != ""){
            echo "<div id='pwdMsg4'><div>";
        }
        if($err2 != ""){
            echo "<div id='err2'><div>";
        }
        
    }
    
    ?>

    <script src="app.js"></script>
</body>
</html>