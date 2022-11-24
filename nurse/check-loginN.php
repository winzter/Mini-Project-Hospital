<?php
    try {
        session_start();
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
        $stmt = $pdo->prepare("SELECT * FROM nurse WHERE nid = ? AND PASSWORD = ?");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->bindParam(2, $_POST["password"]);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!empty($row)) { 
          session_regenerate_id();

          $_SESSION["fullname"] = $row["nfnamelname"];   
          $_SESSION["username"] = $row["nid"];

          echo "เข้าสู่ระบบสำเร็จ<br>";
          header( "refresh:1; url=index.php" );
        } else {
          echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
          header( "location:loginN.php?message=Username or Password not correct!" ); 
        }
    } 
    catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด : ".$e->getMessage();
    }
    
?>
