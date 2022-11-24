<?php
    try {
        session_start();
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
        $stmt = $pdo->prepare("SELECT * FROM doctor WHERE doctor.did = ? AND doctor.password = ?");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->bindParam(2, $_POST["password"]);
        $stmt->execute();
        $row = $stmt->fetch();
        if (!empty($row)) { 
          $_SESSION["fullnameD"] = $row["dfnamelname"];   
          $_SESSION["usernameD"] = $row["did"];

          echo "เข้าสู่ระบบสำเร็จ<br>";
          header( "refresh:1; url=index.php" );

        } else {
          echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
          header( "location:loginD.php?message=Username or Password not correct!" ); 
        }
    } 
    catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด : ".$e->getMessage();
    }
  
?>
