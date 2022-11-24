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
    <script>
        function confirmDelete(sid) {
            var ans = confirm("ต้องการลบรหัสการตรวจ : " + sid);
            if (ans == true) {
                document.location = "deletedos.php?sid=" + sid;
            }
        }
    </script>
    <style>
        #detail {
            text-align: center;
            /* border-radius: 10px;
            border: 1px solid; */
            box-sizing: content-box;
            width: 300px;
            height: 330px;
            margin: auto;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <?php include './navdos.php' ?><br>
    <?php
    $sid = $_POST["sid"];
    $stmt = $pdo->prepare("select * from dos where sid like ?");
    $stmt->bindParam(1, $sid);
    $stmt->execute();
    $row = $stmt->fetch(); ?>
    <div id="detail">
        
        <fieldset>
            <legend><h3>ข้อมูลที่ต้องการจะลบ</h3></legend>
        Doctor's order sheet ID : <?= $row["dosid"] ?><br><br>
        SID : <?= $row["sid"] ?><br><br>
        Order date : <?= $row["dosdate"] ?><br><br>
        Order time : <?= $row["dostime"] ?><br><br>
        Guideline : <?= $row["guideline"] ?><br><br>
        Status : <?= $row["status"] ?><br><br>
        <input type="submit" value="Delete" onclick='confirmDelete("<?= $_POST["sid"] ?>")'>
        </fieldset>
        
    </div>

</body>

</html>