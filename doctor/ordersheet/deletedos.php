<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
$stmt=$pdo->prepare("delete from dos where sid = ?");
$stmt->bindParam(1,$_GET["sid"]);
if($stmt->execute())
{
    header("location:delete.php");
}
?>