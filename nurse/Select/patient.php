<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location: ../loginN.php");
}
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$patient = $pdo->prepare("SELECT * FROM patient");
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
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');
        *{
            font-family: 'Kanit', sans-serif;
        }
        body{
            background-color: #f9f9f9;
        }

        .pid{
            padding: 5px; 
            font-weight: 900;
        }
        .pid:hover{
            border-radius: 5px;
            background-color: #D989B5;
            color: #FFF;
        }

        a{
            text-decoration: none;
            color: #000;
        }

        a:hover{
            font-weight: bold;
        }

        div,h3 {
            text-align: center;
        }

        table {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: #FFFF;
            border-radius: 10px;
            padding: 10px;
            margin: 2rem auto;
            text-align: center;
        }

        th{
            font-size: 20px;
        }
        
        th,td,tr {
            padding: 10px;
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <?php include './nav.php' ?>
    <div>
        <table>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>Age</th>
                <th>Sex</th>
                <th>To do</th>
                <th>History</th>
            </tr>
            <?php while ($row = $patient->fetch()) : ?>
                <tr>
                    <td>
                        <a href="patient_info.php?pid=<?= $row['pid'] ?>&sex=<?= $row['psex'] ?>"
                            class="pid">
                            <?= $row['pid'] ?>
                        </a>
                    </td>
                    <td style="font-weight: bold;"><?= $row['pfnamelname'] ?></td>
                    <td><?= $row['pdob'] ?></td>
                    <td><?= $row['page'] ?></td>
                    <td><?= $row['psex'] ?></td>
                    <td><a href="./patient_follow.php?pid=<?= $row['pid'] ?>" class="pid">To do</a></td>
                    <td><a href="patient_history.php?pid=<?= $row['pid'] ?>" class="pid">History</a></td>
                </tr>
            <?php endwhile ?>
        </table>
    </div>
    <a href="./patient.php">Back</a>
</body>

</html>