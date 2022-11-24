<?php
$pid = $_GET['id'];
try {
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pInfo = $pdo->prepare("SELECT * FROM patient WHERE pid = ?");
    $pInfo->bindParam(1, $pid);
    $pInfo->execute();

    $pTel = $pdo->prepare("SELECT * FROM ptel WHERE pid = ?");
    $pTel->bindParam(1, $pid);
    $pTel->execute();

    $pDisease = $pdo->prepare("SELECT * FROM disease WHERE pid = ?");
    $pDisease->bindParam(1, $pid);
    $pDisease->execute();
} catch (PDOException $e) {
    echo "Connection Fail : " . $e;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');

        body {
            font-family: 'Kanit', sans-serif;
        }

        fieldset {
            border: none;
            border-top: 1px solid pink;
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

        .topnav {
            overflow: hidden;
            background-color: palevioletred;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .account-details {
            display: block;
        }

        .account-details>div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .account-details>div,
        input,
        label {
            width: 100%;
        }

        label {
            padding: 0 3px;
            text-align: right;
        }

        input {
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
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <nav class="topnav">
        <a href="../index.php">homepage</a>
        <a href="../logoutD.php">logout</a>
        <a href="../../other/doctorform.html" style="float:right">medical personnel</a>
    </nav>
    <fieldset>
        <legend>
            <h3>Patient Details</h3>
        </legend>
        <div class="main-block">
            <div>
                <?php while ($row = $pInfo->fetch()) : ?>
                    <div class="account-details">
                        <div><label>Patient ID ⠀⠀⠀</label><input type="text" value="<?= $row['pid'] ?>" readonly></div> <br>
                        <div><label>Name⠀⠀⠀</label><input type="text" value="<?= $row['pfnamelname'] ?>" readonly></div> <br>
                        <div><label>Date of birth ⠀⠀⠀</label><input type="text" value="<?= $row['pdob'] ?>" readonly></div> <br>
                        <div><label>age⠀⠀⠀</label><input type="text" value="<?= $row['page'] ?>" readonly></div> <br>
                        <div><label>Gender ⠀⠀⠀</label><input type="text" value="<?= $row['psex'] ?>" readonly></div> <br>
                    </div>
                <?php endwhile ?>
                <p>Patient Tell. ⠀⠀⠀
                    <?php while ($row = $pTel->fetch()) : ?>
                <div class="bottom"><input type="text" value="<?= $row['pnumber'] ?>" readonly></div>
            <?php endwhile ?>
            </p>
            <p>Patient Disease ⠀⠀⠀ :
                <?php while ($row = $pDisease->fetch()) : ?>
            <div class="bottom"><input type="text" value="<?= $row['pdisease'] ?>" readonly></div>
        <?php endwhile ?>
        </p>
            </div>
        </div>
    </fieldset>

    <button> <a href="../index.php">back to home doctor</a> </button>
</body>

</html>