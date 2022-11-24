<?php
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
    <?php
    $status = "Active";
    $seeadoctor = $pdo->prepare("insert into seeadoctor(did,pid,entrydate) values(?,?,curdate())");
    $seeadoctor->bindParam(1,$_POST["did"]);
    $seeadoctor->bindParam(2,$_POST["pid"]);
    $seeadoctor->execute();
    $stmt = $pdo->prepare("select sid from seeadoctor order by sid desc limit 1");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $sid = $row['sid'];
    }
    header("location:insertguideline.php?sid=$sid");
?>