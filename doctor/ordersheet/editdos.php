<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    //$sid = $_POST["sid"];
    $stmt = $pdo->prepare("update dos set dosdate=curdate(),dostime=curtime(),guideline=?  where sid like ?");
    $stmt->bindParam(1, $_GET["guideline"]);
    $stmt->bindParam(2, $_GET["sid"]);
    if ($stmt->execute()) {
        header("location:edit.php");
    } ?>
</body>

</html>