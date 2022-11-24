<?php
    $pdo = new PDO("mysql:host=localhost; dbname=system_hospital; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
?>

<?php
    $stmt = $pdo->prepare("UPDATE nurse SET nurse.password=? WHERE nid=?"); 
    $stmt->bindParam(1, $_POST["password"]); 
    $stmt->bindParam(2, $_POST["nid"]);

    $oldPass = $pdo->prepare("SELECT nurse.password FROM nurse WHERE nid = ?");
    $oldPass->bindParam(1,$_POST['nid']);
    $oldPass->execute();
    $row = $oldPass->fetch();
    if($oldPass->execute()){
        $row = $oldPass->fetch();
        if($_POST['Opass'] != $row['password']){
            echo "Old Passworld ไม่ถูกต้อง";
            header( "refresh:1; url=index.php" );
        }else{
            if($stmt->execute()){
                echo "finish" . $_POST["nid"] . "Change Password";
                echo "กลับหน้าหลัก" ;
                header( "refresh:1; url=index.php" );
            }
        }
    }

    // $stmt = $pdo->prepare("UPDATE doctor SET doctor.password=? WHERE did=?"); 
    // $stmt->bindParam(1, $_POST["password"]); 
    // $stmt->bindParam(2, $_POST["did"]); 
    // if ($stmt->execute()){
    //     echo "finish" . $_POST["did"] . "Change Password";
    //     echo "กลับหน้าหลัก" . "<a href='4.php'>This is a link</a>";
    // }

    
?>