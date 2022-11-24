<?php
session_start();
if (empty($_SESSION['usernameD'])) {
    header("location: loginD.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/dos.css">
    <style>
        /* .sidebar {
            height: 100%;
            width: 15%;
            position: fixed;
            z-index: -999;
            background-color: pink;
            padding-top: 16px;
        }
        img{
            height: 150px;
            width: 5rem;
        }
        .imgContainer{
            text-align: center;
        } */
    </style>
    <title>Document</title>
</head>
<body>
    <?php include './nav.php' ?>
    <!-- <aside class="sidebar">
        <div class="imgContainer"><img src="../img/doctor/<?=$_SESSION['usernameD']?>.jpg" alt="doctor"></div>
    </aside> -->
    <nav class="nav flex-column">
        <br>
        <a href="ordersheet/insert.php">Doctor's order sheet</a> | 
        <a href="check/check-doctor.php">หมอคนไหนรักษาคนไข้คนไหนบ้าง</a><br>
    </nav>

</body>

</html>