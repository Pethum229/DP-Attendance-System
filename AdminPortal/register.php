<?php include "../inc_header.php"; ?>
    <title>Register</title>
</head>
<body>
    <form name="register" action="">
        <input type="text" placeholder="Username">
        <select name="cName" id="campusName">
            <option value="0">Select Your DP IT Campus</option>
            <option value="28">DP IT Campus Hathagala</option>
            <option value="29">DP IT Campus Udhdhakandara</option>
            <option value="30">DP IT Campus Tangalle</option>
            <option value="31">DP IT Campus Ambalanthota</option>
            <option value="32">DP IT Campus Embilipitiya</option>
        </select>
        <input type="password" placeholder="New Password">
        <input type="password" placeholder="Confirm New Password">
        <div>
            <input type="submit" value="Register" name="submit">
            <input type="reset" value="Reset Form">
        </div>
    </form>
</body>
</html>