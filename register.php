<?php include "inc_header.php"; ?>
    <title>Register</title>
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
    section{
      background-color: rgba(13, 17, 23, 0.9);
      padding: 20px;
      border-radius: 8px;
      width:500px;
      box-shadow: 0 0 10px rgba(0, 199, 199, 0.7);
    }
    .register{
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .register>h1{
        font-family:var(--actor);
        text-transform:uppercase;
        text-align:center;
        margin-bottom:10px;
        font-size:45px;
    }
    .register>i{
        font-size:40px;
        margin-left:20px;
        padding-bottom:10px;
    }

    /* Form Inputs */
    input,select {
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
        <div class="register">
            <h1>Register</h1>
            <i class="fa-solid fa-address-book"></i>
            <i></i>
        </div>
        <form name="register" method="POST">
            <input type="text" name="email" placeholder="Email">
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
            <div class="footer">
                <p>Already have an account ? <a href="login.php">Login</a></p>
            </div>
        </form>
    </section>

    <?php

    if(isset($_POST['submit'])){

        include "db_connection.php";
    
        $pwd= password_hash($_POST['aPwd'],PASSWORD_DEFAULT);
    
        $adminInsert = $db->prepare("INSERT INTO `admins` (`CampusId`,`Email`,`Username`,`Password`)
                                            VALUES (?,?,?,?)")->execute(array($_POST['cName'],$_POST['email'],$_POST['aName'],$pwd));
        
        echo "Admin registered successfully";
    
        if($adminInsert){
            header("location:login.php");
        }
    }


    ?>
</body>
</html>