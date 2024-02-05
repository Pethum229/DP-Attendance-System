<?php include "layout.php"; ?>
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
    <section class="row">
        <h1>Change Your Password</h1>
        <form action="">
            <input type="text" placeholder="Current Password">
            <input type="text" placeholder="New Password">
            <input type="text" placeholder="Confirm New Password">
            <input class="buttons" type="submit" value="Reset Password">
        </form>
    </section>


    </div>
</div>
</body>
</html>