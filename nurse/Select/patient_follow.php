<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location: ../loginN.php");
}
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div,
        h3 {
            text-align: center;
        }

        form,
        table {
            margin: auto;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
        }

        input[type='text'] {
            padding: 5px;
        }

        input[type='submit'] {
            cursor: pointer;
            padding: 5px;
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
    </style>
</head>

<body>
    <?php include './nav.php'?>
    <h3>เช็คสิ่งที่พยาบาลต้องดูแลคนไข้</h3>
    <br>
    <div>
        <?php
        $stmt = $pdo->prepare("SELECT DISTINCT patient.pid , patient.pfnamelname , dos.guideline , dos.dosdate , dos.dostime , dos.status
                                FROM patient JOIN seeadoctor JOIN dos 
                                ON patient.pid = seeadoctor.pid AND seeadoctor.sid = dos.sid
                                AND patient.pid = ? AND dos.status = 'Active'");

        if (!empty($_GET['pid'])) {
            $value = $_GET["pid"];
            $stmt->bindParam(1, $value);
            $stmt->execute();
            $resultCount = $stmt->rowCount();
            if ($resultCount > 0) { ?>
                ค้นพบ <?= $resultCount ?> ผลลัพธ์ที่ตรงกัน<br><br>
                <table border="1">
                    <tr>
                        <th>รหัสคนไข้</th>
                        <th>ชื่อคนไข้</th>
                        <th>สิ่งที่ต้องทำ</th>
                        <th>วัน เดือน ปี ที่สั่ง</th>
                        <th>เวลาที่สั่ง</th>
                        <th>สถานะ</th>
                    </tr>

                    <?php
                    while ($row = $stmt->fetch()) { ?>
                        <tr>
                            <td><?= $row['pid'] ?></td>
                            <td><?= $row['pfnamelname'] ?></td>
                            <td><?= $row['guideline'] ?></td>
                            <td><?= $row['dosdate'] ?></td>
                            <td><?= $row['dostime'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br> <br>
        <?php } else {
                echo "ไม่พบข้อมูล";
            }
        } ?>
        <button> <a href="./patient.php">Back</a> </button>
    </div>
</body>

</html>