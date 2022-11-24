<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location: loginN.php");
}
$nid = $_GET['nid'];
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$nurse = $pdo->prepare("SELECT * FROM nurse WHERE nid = ?");
$nurse->bindParam(1, $nid);
$nurse->execute();

$nurseTel = $pdo->prepare("SELECT * FROM ntel WHERE nid = ?");
$nurseTel->bindParam(1, $nid);
$nurseTel->execute();

$nurseEmail = $pdo->prepare("SELECT * FROM nemail WHERE nid = ?");
$nurseEmail->bindParam(1, $nid);
$nurseEmail->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bottom {
            margin-bottom: 5px;
        }

        button {
            width: 100%;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background: pink;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        button:hover {
            background: palevioletred;
        }

        .contain {
            padding: 20px 250px;
            display: flex;
            flex-direction: column;
        }

        .main-block {
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include './nav.php' ?>
    <div class="contain">
        <legend>
            <h3> Nurse name : <?= $_SESSION['fullname'] ?></h3>
        </legend>
    <div>
        <?php while ($row = $nurse->fetch()) : ?>
            <div class="main-block">
                    <img src="../img/nurse/<?= $row['nid'] ?>.jpg" width="250px" height="auto" alt="">
            </div>

            <br>
            <hr>

            <p>Nurse ID : <?= $row['nid'] ?></p>
            <p>Firstname Lastname : <?= $row['nfnamelname'] ?></p>
            <p>Position : <?= $row['nposition'] ?></p>
        <?php endwhile ?>
        <p>Tel :
            <?php while ($row = $nurseTel->fetch()) : ?>
                <?= $row['nnumber'] ?>
            <?php endwhile ?>
        </p>
        <p>Email :
            <?php while ($row = $nurseEmail->fetch()) : ?>
                <?= $row['nmail'] ?>
            <?php endwhile ?>
        </p>
        <hr>
        
    </div>
    </div>
    <button> <a href="index.php">Back to homepage</a> </button>
</body>

</html>