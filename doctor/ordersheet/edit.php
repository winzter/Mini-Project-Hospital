<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/dos.css">
    <style>
        #form{
            text-align: center;
        }
        .option{
            padding-left: 10px;
        }
        #button{
            width: 70px;
        }
    </style>
</head>

<body>
    <?php include './navdos.php' ?><br>
    <div class="option">
    <a href="insert.php">Insert</a> |
    <a href="edit.php">Edit</a> |
    <a href="delete.php">Delete</a> <br>
    </div>
    <form action="editform.php" method="post" id="form">
        <h3>Update Doctor's order sheet detail</h3>
        <input type="hidden" name="did" value="<?= $_SESSION['usernameD'] ?>">
        <label for="sid">ค้นหารหัสการตรวจ : </label>
        <input type="text" id="sid" name="sid" required pattern="[Ss]\d{3}">
        <input type="submit" id="search" name="search" value="Next"><br><br>
    </form>


</body>

</html>