<?php

if(isset($_POST['submit'])){

    // Variable Define
    $usernameMsg1="";
    $usernameMsg2=""; 
    $emailMsg1="";
    $emailMsg2="";
    $emailMsg3="";
    $pwdMsg1="";
    $pwdMsg2="";
    $campusMsg="";
    $resgisterSuccess="";
    $dbErr="";
    $err="";

    // Username Validation
    $_POST['aName'] = htmlspecialchars(trim($_POST['aName']),ENT_QUOTES,'UTF-8');
    if(empty($_POST['aName'])) $usernameMsg1 = "Username cannot be empty.";

    // Password Validation
    if (empty($_POST['aPwd']) || empty($_POST['aCPwd'])) $pwdMsg1 = "Password cannot be empty.";
    elseif ($_POST['aPwd'] != $_POST['aCPwd']) $pwdMsg2 = "Password do not match with confirm password.";

    // Email Validation
    $_POST['email'] = trim($_POST['email']);
    if (empty($_POST['email'])) $emailMsg1 = "Email cannot be empty.";
    elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) $emailMsg2 = "Email address is not valid.";


    // DB Operations
    if ($usernameMsg1 == "" && $emailMsg1 == "" && $emailMsg2 == "" && $pwdMsg1 == "" && $pwdMsg2 == "") {
        try{
            include "db_connection.php";

            // Check for existing campus
            $checkCampus = $db->prepare("SELECT `id` FROM `admins` WHERE `CampusId`=?");
            $checkCampus->execute(array($_POST['cName']));
            
            // Check for existing Username
            $checkUsername = $db->prepare("SELECT `id` FROM `admins` WHERE `Username`=?");
            $checkUsername->execute(array($_POST['aName']));

            // Check for existing email
            $checkEmail = $db->prepare("SELECT `id` FROM `admins` WHERE `email`=?");
            $checkEmail->execute(array($_POST['email']));

            if ($checkCampus->rowCount()>0) $campusMsg = "Your campus account is already registered.";
            elseif($checkUsername->rowCount()>0) $usernameMsg2 = "This username is already taken.";
            elseif($checkEmail->rowCount()>0) $emailMsg3 = "This email is already taken.";
            else{
                // Insert User
                $pwd= password_hash($_POST['aPwd'],PASSWORD_DEFAULT);

                $adminInsert = $db->prepare("INSERT INTO `admins` (`CampusId`,`Email`,`Username`,`Password`)
                                                    VALUES (?,?,?,?)")->execute(array($_POST['cName'],$_POST['email'],$_POST['aName'],$pwd));

                if($adminInsert){
                    header("location:login.php?registered=1");
                    exit;
                }else{
                    $dbErr = "Something went wrong! Please contact website admin";
                }
            }
        }catch(PDOException $e){
            $err = $e->getMessage();
        }
    }

    // Create div for toast animation and javascript
    if($usernameMsg1 != ""){
        echo "<div id='usernameMsg1'><div>";
    }
    if($usernameMsg2 != ""){
        echo "<div id='usernameMsg2'><div>";
    }
    if($emailMsg1 != ""){
        echo "<div id='emailMsg1'><div>";
    }
    if($emailMsg2 != ""){
        echo "<div id='emailMsg2'><div>";
    } 
    if($emailMsg3 != ""){
        echo "<div id='emailMsg3'><div>";
    }
    if($pwdMsg1 != ""){
        echo "<div id='pwdMsg1'><div>";
    }
    if($pwdMsg2 != ""){
        echo "<div id='pwdMsg2'><div>";
    }
    if($campusMsg != ""){
        echo "<div id='campusMsg'><div>";
    }
    if($dbErr != ""){
        echo "<div id='dbErr'><div>";
    }
    if($err != ""){
        echo "<div id='err'><div>";
    }
}

?>


<?php include "inc_header.php"; ?>
    <title>Register</title>
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
            <input type="email" required name="email" maxlength="60" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>">
            <input type="text" required name="aName" placeholder="Username" value="<?php if(isset($_POST['aName'])) echo $_POST['aName'] ?>">
            <select required name="cName" id="campusName">
                <option value="0">Select Your DP IT Campus</option>
                <option value="28">DP IT Campus Hathagala</option>
                <option value="29">DP IT Campus Udhdhakandara</option>
                <option value="30">DP IT Campus Tangalle</option>
                <option value="31">DP IT Campus Ambalanthota</option>
                <option value="32">DP IT Campus Embilipitiya</option>
            </select>
            <input type="password" required name="aPwd" maxlength="50" placeholder="New Password">
            <input type="password" required name="aCPwd" maxlength="50" placeholder="Confirm New Password">
            <div>
                <input type="submit" value="Register" name="submit">
                <input type="reset" value="Reset Form">
            </div>
            <div class="footer">
                <p>Already have an account ? <a href="login.php">Login</a></p>
            </div>
        </form>
    </section>

    <div class="notifications"></div>

    <script src="app.js"></script>
</body>
</html>