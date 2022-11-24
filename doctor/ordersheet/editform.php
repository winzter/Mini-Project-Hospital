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
        function confirmEdit(sid) {
            var guideline = document.getElementById("guideline").value;
            var ans = confirm("ต้องการแก้ข้อมูลในรหัสการตรวจ : " + sid);
            if (ans == true) {
                document.location = "editdos.php?sid=" + sid + "&guideline=" + guideline;
            }
        }
    </script>
    <style>
        #form{
            text-align: center;
        }
        .option{
            padding-left: 10px;
        }
        #button{
            width: 70px;
        }
    </style>
</head>

<body>
    <?php include './navdos.php' ?><br>
    <?php
    $sid = $_POST["sid"];
    $stmt = $pdo->prepare("select sid from dos where sid like ?");
    $stmt->bindParam(1, $sid);
    $stmt->execute();
    $row = $stmt->fetch(); ?>
    <div id="form">
        <h3>รหัสการตรวจ : <?= $sid ?></h3>
        <label for="guide">Guideline : </label><br>
        <textarea name="guideline" id="guideline" cols="30" rows="5" required></textarea><br>
        <input type="submit" value="Update" onclick='confirmEdit("<?= $_POST["sid"] ?>")'>
    </div>
</body>

</html>