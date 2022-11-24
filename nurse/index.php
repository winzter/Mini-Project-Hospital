<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location: loginN.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'nav.php' ?>
    <br>
    <a href="./Select/patient.php">Patients</a> |
    <a href="./Insert/patient_form.php">Add Patient</a>
</body>

</html>