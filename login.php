<?php include "inc_header.php"; ?>
    <title>Login</title>
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
    <section>
        <div class="login">
            <h1>Login</h1>
            <i class="fa-solid fa-right-to-bracket"></i>
        </div>
        <form name="login" method="POST">
            <input type="text" name="aName" placeholder="Username">
            <input type="password" name="aPwd" placeholder="Password" >
            <input type="submit" value="Login" name="submit">
        </form>
        <div class="footer">
            <p>You haven't account ? <a href="register.php">Register</a></p>
            <a href="#">Forgot Password</a>
        </div>
    </section>

    <?php

    if(isset($_POST['submit'])){
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
                        $_SESSION['name']= $result['Username'];
                    
                        echo "Successfully loggedin";
                    
                        // Redirect to homepage
                        header("location:AdminPortal/dashboard.php");
                    }
                
                }
            }

        }catch (PDOException $e){
            $msg.=$e->getMessage();
        }
    }

    ?>
</body>
</html>