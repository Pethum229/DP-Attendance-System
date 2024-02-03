<title>Dashboard | Admin Portal</title>
<style>
    .cardBox{
        position:relative;
        width:100%;
        padding:20px;
        display:grid;
        grid-template-columns:repeat(4,1fr);
        grid-gap:30px;
    }
    .cardBox .card{
        position: relative;
        background: var(--white);
        padding:30px;
        border-radius:20px;
        display:flex;
        justify-content:space-between;
        cursor:pointer;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
    }
    .cardBox .card .numbers{
        position: relative;
        font-weight:500;
        font-size:2.5em;
        color:var(--blue);
    }
    .cardBox .card .cardName{
        color:var(--black2);
        font-size:1.1em;
        margin-top:5px;
    }
    .cardbox .card .iconBx{
        font-size:3.5em;
        color:var(--black2);
    }
    .cardBox .card:hover{
        background:var(--blue);
    }
    .cardBox .card:hover .numbers,
    .cardBox .card:hover .cardName,
    .cardBox .card:hover .iconBx{
        color:var(--white);
    }

    /* Data List */
    .details{
        position: relative;
        width:100%;
        padding:20px;
        display:grid;
        grid-template-columns:2fr 1fr;
        grid-gap:30px;
        /* margin-top:10px; */
    }
    .details .recentOrders{
        position:relative;
        display:grid;
        min-height:500px;
        background:var(--white);
        padding:20px;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .cardHeader{
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
    }
    .cardHeader{
        font-weight:600;
        color:var(--blue);
    }
    .btn{
        position:relative;
        padding:5px 10px;
        background:var(--blue);
        text-decoration:none;
        color:var(--white);
        border-radius:6px;
    }
    .details .table{
        width:100%;
        border-collapse:collapse;
        margin-top:10px;
    }
    .details table thead td{
        font-weight:600;
    }
    .details .recentOrders table tr{
        color:var(--black1);
        border-bottom:1px solid rgba(0,0,0,0.1);
    }
    .details .recentOrders table tr:last-child{
        border-bottom:none;
    }
    .details .recentOrders table tbody tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .details .recentOrders table tr td{
        padding:10px;
    }
    .details .recentOrders table tr td:last-child{
        text-align:end;
    }
    .details .recentOrders table tr td:nth-child(2){
        text-align:end;
    }
    .details .recentOrders table tr td:nth-child(3){
        text-align:center;
    }

    /* New Students */
    .recentCustomers{
        position: relative;
        display:grid;
        min-height:500px;
        padding:20px;
        background:var(--white);
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .recentCustomers .imgBx{
        position: relative;
        width:40px;
        height:40px;
        border-radius:50%;
        overflow:hidden;
    }
    .recentCustomers .imgBx img{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        object-fit:cover;
    }
    .recentCustomers table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .recentCustomers table tr td{
        padding:12px 10px;
    }
    .recentCustomers table tr td h4{
        font-size:16px;
        font-weight:500;
        line-height:1.2em;
    }
    .recentCustomers table tr td h4 span{
        font-size:14px;
        color:var(--black2);
    }
    .recentCustomers table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .recentCustomers table tr:hover td h4 span{
        color:var(--white);
    }
    </style>
<?php include "layout.php"; ?>
    <!-- <button><a href="daily_attendance.php">Today Students</a></button>
    <button><a href="add.php">Add New Student</a></button>
    <button><a href="all.php">Registered Students</a></button>
    <button><a href="removed.php">Not Attended Students</a></button>
    <button><a href="setting.php">Settings</a></button>
    <button><a href="check.php">Check Students</a></button>
    <button><a href="timetable.php">Make Time Table</a></button>
    <button><a href="../logout.php">Log Out</a></button> -->

            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Total Students</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">50</div>
                        <div class="cardName">Daily Attended Students</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">12</div>
                        <div class="cardName">Not Attended Students</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="alert-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">30</div>
                        <div class="cardName">Removed Students</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="details">
                <!-- Data List  -->
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Last Attended Students</h2>
                        <a href="#" class="btn">View All Students</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Student ID</td>
                                <td>Student Name</td>
                                <td>ClockIn Time</td>
                                <td>ClockOut Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0237Hp</td>
                                <td>D.A Pethum Priyashantha</td>
                                <td>10.37 A.M</td>
                                <td>12.02 P.M</td>
                            </tr>
                            <tr>
                                <td>0037Hp</td>
                                <td>D.A Sahan Sandeepa</td>
                                <td>09.01 A.M</td>
                                <td>01.02 P.M</td>
                            </tr>
                            <tr>
                                <td>0124Hp</td>
                                <td>P.P Rasanjana</td>
                                <td>05.37 A.M</td>
                                <td>7.35 P.M</td>
                            </tr>
                            <tr>
                                <td>0148Hp</td>
                                <td>C.D Chandeepa Sathsara</td>
                                <td>11.05 A.M</td>
                                <td>2.12 P.M</td>
                            </tr>
                            <tr>
                                <td>0421Hp</td>
                                <td>K.K Chabiitha</td>
                                <td>05.45 A.M</td>
                                <td>01.01 P.M</td>
                            </tr>
                            <tr>
                                <td>0245Hp</td>
                                <td>O.O Kavishka Rathnayake</td>
                                <td>08.45 A.M</td>
                                <td>03.35 P.M</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- New Students -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>New Students</h2>
                    </div>
                    <table>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/OIP.jpg"></div></td>
                            <td><h4>Pethum<br><span>Hathagala</span></h4></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>