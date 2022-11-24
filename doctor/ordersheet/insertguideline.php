<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/dos.css">
    <style>
        #form {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include './navdos.php' ?><br>
    <?php
    $sid = $_GET["sid"];
    $stmt = $pdo->prepare("select sid from seeadoctor where sid=?");
    $stmt->bindParam(1, $_GET["sid"]);
    $stmt->execute();
    $row = $stmt->fetch(); ?>
    <div id="form">
        <h3>รหัสการตรวจ : <?= $row["sid"] ?></h3>
        <form action="insertdos.php">
            <input type="hidden" name="sid" value="<?= $sid ?>">
            <label for="guide">Guideline : </label><br>
            <textarea name="guideline" cols="30" rows="5" required></textarea><br>
            <input type="submit" value="Insert">
        </form>
    </div>


</body>

</html>