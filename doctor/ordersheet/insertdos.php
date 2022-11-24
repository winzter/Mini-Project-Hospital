<?php
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
    $status = "Active";
    $stmt = $pdo->prepare("insert into dos (sid,dosdate,dostime,guideline,status)
                        values(?,curdate(),curtime(),?,?)");
    $stmt->bindParam(1, $_GET["sid"]);
    $stmt->bindParam(2, $_GET["guideline"]);
    $stmt->bindParam(3, $status);
    if($stmt->execute())
    {
        header("location:insert.php");
    }
    
?>