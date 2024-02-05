<?php include "layout.php"; ?>
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
        background: #11161d;
        padding:30px;
        border-radius:20px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
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
        text-align:center;
    }
   .iconBx ion-icon{
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
    .details .lastAttendance{
        position:relative;
        display:grid;
        min-height:200px;
        background:#11161d;
        padding:20px;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .cardHeader{
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-weight:600;
        color:var(--blue);
        height:fit-content;
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
        color:var(--white);
    }
    .details .lastAttendance table tr{
        color:var(--black2);
        border-bottom:1px solid rgba(255,255,255,0.4);
    }
    .details .lastAttendance table tr:last-child{
        border-bottom:none;
    }
    .details .lastAttendance table tbody tr:hover{
        background:var(--blue);
        color:var(--white);
        border-radius:10px;
    }
    .details .lastAttendance table tr td{
        padding:10px;
    }
    .details .lastAttendance table tr td:last-child{
        text-align:center;
    }
    .details .lastAttendance table tr td:nth-child(3){
        text-align:center;
    }

    /* New Students */
    .highPerformance{
        position: relative;
        display:grid;
        min-height:500px;
        padding:20px;
        background:#11161d;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }
    .highPerformance .imgBx{
        position: relative;
        width:40px;
        height:40px;
        border-radius:50%;
        overflow:hidden;
    }
    .highPerformance .imgBx img{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        object-fit:cover;
    }
    .highPerformance table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .highPerformance table tr td{
        padding:12px 10px;
    }
    .highPerformance table tr td h4{
        font-size:16px;
        font-weight:500;
        line-height:1.2em;
    }
    .highPerformance table tr td h4 span{
        font-size:14px;
        color:var(--black2);
    }
    .highPerformance table tr:hover{
        background:var(--blue);
        color:var(--white);
    }
    .highPerformance table tr:hover td h4 span{
        color:var(--white);
    }
    .one{
        color:#FFD700;
    }
    .two{
        color:#800080;
    }
    .three{
        color: #C0C0C0;
    }
    .four{
        color:#E5E4E2;
    }
    .five{
        color:#CD7F32;
    }
    </style>

            <div class="cardBox">
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                    <div class="cardName">Total Students</div>
                    <div class="numbers">1,504</div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                    <div class="cardName">Daily Attended Students</div>
                    <div class="numbers">50</div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="alert-outline"></ion-icon>
                    </div>
                    <div class="cardName">Not Attended Students</div>
                    <div class="numbers">12</div>
                </div>
                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="cardName">Removed Students</div>
                    <div class="numbers">30</div>
                </div>
            </div>

            <div class="details">
                <!-- Data List  -->
                <div class="lastAttendance">
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
                <div class="highPerformance">
                    <div class="cardHeader">
                        <h2>High Performance</h2>
                    </div>
                    <table>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/1.png"></div></td>
                            <td><h4 class="one">Sahan Sandeepa<br><span>0037Hp</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/2.png"></div></td>
                            <td><h4 class="two">Ravindu Rasanjana<br><span>0547Hp</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/3.png"></div></td>
                            <td><h4 class="three">Chandeepa Sathsara<br><span>0214Hp</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/4.png"></div></td>
                            <td><h4 class="four">Vihanga Vindoya<br><span>0287Hp</span></h4></td>
                        </tr>
                        <tr>
                            <td width="60px"><div class="imgBx"><img src="../images/5.png"></div></td>
                            <td><h4 class="five">Kavishka Rathnayaka<br><span>0784Hp</span></h4></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>