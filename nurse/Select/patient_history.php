<?php
    session_start();
    if(empty($_SESSION['username'])){
       header("location: ../loginN.php");
    }
    $pid = $_GET['pid'];
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $patient = $pdo->prepare("SELECT * FROM followorder WHERE followorder.dosid IN
                                (SELECT dos.dosid FROM dos WHERE dos.sid IN
                                    (SELECT seeadoctor.sid FROM seeadoctor WHERE seeadoctor.pid = ?))");
    $patient->bindParam(1,$pid);
    $patient->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            margin: auto;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
        }
        .bottom {
            margin-bottom: 5px;
        }

        button {
            width: 100%;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background: pink;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        button:hover {
            background: palevioletred;
        }
        .contain {
            padding: 20px 150px;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<?php include 'nav.php' ?> <br> 
<div class="contain">
<?php if($patient->rowCount() > 0){?>
        <table class="table"  border="1" >
            <tr>
                <th>Nurse ID</th>
                <th>Doctor's order sheet ID</th>
                <th>Follow Date</th>
                <th>Follow Time</th>
                <th>Detail</th>
            </tr>
            <?php while($row = $patient->fetch()) : ?>
                <tr>
                    <td><?=$row['nid']?></td>
                    <td><?=$row['dosid']?></td>
                    <td><?=$row['followdate']?></td>
                    <td><?=$row['followtime']?></td>
                    <td><?=$row['detail']?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php } 
    else{
        echo "Patient's history not found.<br>";
    } ?>
    

</div>
    
    <button>
    <a href="patient.php">back to previous page</a>
    </button>
</body>
</html>