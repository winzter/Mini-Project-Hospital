<?php
session_start();
if (empty($_SESSION['usernameD'])) {
    header("location: loginD.php");
}
$pdo = new PDO("mysql:host=localhost; dbname=system_hospital; charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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

        a:hover{
            font-weight: bold;
        }

        div,h3 {
            text-align: center;
        }

        table {
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


        form,
        h3 {
            text-align: center;
        }

        .topnav {
            overflow: hidden;
            background-color: palevioletred;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .contain {
            padding: 20px 250px;
            display: flex;
            flex-direction: column;
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
    <form action="">
    <?php include './nav.php' ?>
        

        <br>
        <br>
        <h4>
            <h3>เช็คว่าหมอคนนี้รักษาคนไข้คนไหนบ้าง</h3>
            <form action="">
                ใส่ Username หมอ <input type="text" name="keyword">
                <input type="submit">
            </form>
        </h4>

    </form>

    <?php
    $stmt = $pdo->prepare("SELECT DISTINCT dfnamelname,pfnamelname,patient.pid FROM doctor
                                JOIN seeadoctor JOIN patient ON doctor.did = seeadoctor.did
                                AND seeadoctor.pid = patient.pid
                                WHERE doctor.did like ? ");
    if (!empty($_GET))
        $value = '%' . $_GET["keyword"] . '%';
    $stmt->bindParam(1, $value);
    $stmt->execute();
    ?>

    <div class="contain">
        <table class="table">
            <tr>
                <th> Doctor Name</th>
                <th> Patient Name</th>
                <th> Detail Patient </th>
            </tr>
            <?php while ($row = $stmt->fetch()) : ?>
                <tr>
                    <td> <?= $row[0] ?> </td>
                    <td> <?= $row[1] ?> </td>
                    <?php echo "<td align='center'><a href='detail-patient.php?id=" . $row[2] . "' class='pid'>" . "detail" . "</a></td>"; ?>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <button>
    <a href="../index.php">back to home doctor</a>
    </button>
</body>

</html>