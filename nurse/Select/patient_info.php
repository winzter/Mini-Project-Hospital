<?php
    session_start();
    if(empty($_SESSION['username'])){
       header("location: ../loginN.php");
    }
    $pid = $_GET['pid'];
    $sex = $_GET['sex'];
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $pInfo = $pdo->prepare("SELECT * FROM patient WHERE pid = ?");
        $pInfo->bindParam(1,$pid);
        $pInfo->execute();

        $pTel = $pdo->prepare("SELECT * FROM ptel WHERE pid = ?");
        $pTel->bindParam(1,$pid);
        $pTel->execute();

        $pDisease = $pdo->prepare("SELECT * FROM disease WHERE pid = ?");
        $pDisease->bindParam(1,$pid);
        $pDisease->execute();

        $date = $pdo->prepare("SELECT DISTINCT entrydate , leavedate FROM seeadoctor WHERE pid = ?");
        $date->bindParam(1,$pid);
        $date->execute();
        $pdate = $date->fetch();
        if(!isset($pdate['entrydate'])){
            $pdate['entrydate']="";
        }
        if(!isset($pdate['leavedate'])){
            $pdate['leavedate']="";
        }
    }
    catch(PDOException $e){
        echo "Connection Fail : ".$e;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-family: 'Kanit', sans-serif;
        }
        fieldset {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin: 0 auto;
            width: 20%;
            border: 1px solid pink;
            border-radius: 5px;
        }

        .btn {
            text-decoration: none;
            width: 10vw;
            padding: 10px 20px;
            margin: 0 auto;
            border-radius: 5px;
            border: none;
            background: pink;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .btn:hover {
            background: palevioletred;
        }

        .btncontainer{
            width: fit-content;
            margin: 3vh auto;
        }

        .account-details {
            display: block;
        }

        .account-details > div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .account-details > div,
        input
        {
            width: 100%;
        }

        label , .row{
            width: 100%;
        }

        label {
            font-weight: bold;
            padding: 0 3px;
        }

        input {
            text-align: center;
            font-weight: bold;
            font-family: 'Kanit', sans-serif;
            padding: 5px;
            vertical-align: middle;
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
        }

        .bottom {
            text-align: center;
            margin: 5px 10px;
        }

        .bottom input{
            width: 50%;
        }
        
    </style>
</head>

<body>
    <?php include './nav.php' ?>
    <fieldset>
        <legend>
            <h3>Patient Details</h3>
        </legend>

        <div class="main-block">
            <div>
                <?php while ($row = $pInfo->fetch()) : ?>
                    <div class="account-details">
                        <div><label>Patient ID ⠀⠀⠀</label><input class="row"  type="text" value="<?= $row['pid'] ?>" readonly></div> <br>
                        <div><label>Name⠀⠀⠀</label><input class="row"  type="text" value="<?= $row['pfnamelname']?>"  readonly></div> <br>
                        <div><label>Date of birth ⠀⠀⠀</label><input class="row" type="text" value="<?= $row['pdob'] ?>" readonly></div> <br>
                        <div><label>Age⠀⠀⠀</label><input class="row" type="text" value="<?= $row['page'] ?>" readonly></div> <br>
                        <div><label>Gender ⠀⠀⠀</label><input class="row" type="text" value="<?= $row['psex'] ?>" readonly></div> <br>
                    </div>
                <?php endwhile ?>
                <label>Patient Tell. ⠀⠀⠀</label>
                <?php while ($row = $pTel->fetch()) : ?>
                <div class="bottom">
                    <input type="text" value="<?= $row['pnumber'] ?>" readonly>
                </div>
                <?php endwhile ?>
            
                <label>Patient Disease ⠀⠀⠀</label>
                <?php while ($row = $pDisease->fetch()) : ?>
                <div class="bottom">
                    <input type="text" value="<?= $row['pdisease'] ?>" size="10" readonly>
                </div>
                <?php endwhile ?>
            </div>
        </div>

        <div class="btncontainer">
            <a class="btn" href="./patient.php">Back</a>
            <a class="btn" href="./edit_patient.php?pid=<?=$pid?>&sex=<?=$sex?>">Edit</a>
        </div>
    </fieldset>
    

</body>

</html>