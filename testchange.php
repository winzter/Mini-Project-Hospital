<?php
session_start();
if (empty($_SESSION['usernameD'])) {
    header("location: loginD.php");
}
$pdo = new PDO("mysql:host=localhost; dbname=system_hospital; charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
$did = $_GET['did'];
$stmt = $pdo->prepare("SELECT * FROM doctor WHERE did = ?");
$stmt->bindParam(1, $_GET["did"]);
$stmt->execute();
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html>

<head>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script>
        function check() {
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>
    <style>
        html,
        body {
            min-height: 100%;
        }

        body,
        div,
        form,
        input,
        select,
        p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
        }

        h1 {
            margin: 0;
            font-weight: 400;
        }

        h3 {
            margin: 12px 0;
            color: pink;
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
        }

        form {
            width: 100%;
            padding: 20px;
        }

        fieldset {
            border: none;
            border-top: 1px solid pink;
        }

        .account-details,
        .personal-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .account-details>div,
        .personal-details>div>div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .account-details>div,
        .personal-details>div,
        input,
        label {
            width: 100%;
        }

        label {
            padding: 0 5px;
            text-align: right;
            vertical-align: middle;
        }

        input {
            padding: 5px;
            vertical-align: middle;
        }

        select,

        select {
            background: transparent;
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

        @media (min-width: 568px) {

            .account-details>div,
            .personal-details>div {
                width: 50%;
            }

            label {
                width: 40%;
            }

            input {
                width: 60%;
            }

            select,
            .children,
            .gender,
            .bdate-block {
                width: calc(60% + 16px);
            }
        }
    </style>
</head>

<body>
    <div class="main-block">
        <form action="editpassworddoctor.php">
            <h1>Change Password</h1>
            <fieldset>
                <legend>
                    <h3>Details</h3>
                </legend>
                <div class="account-details">
                    <div><label>Doctor ID  ⠀⠀⠀⠀⠀⠀</label><input type="text" name="did" value="<?= $did ?>" readonly></div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h3>ChangePassword </h3>
                </legend>
                <div class="personal-details">
                    <div>
                        <div><label>Old Password ⠀⠀⠀⠀⠀⠀</label><input type="text" name="Opass" required pattern="\d{8,20}"><br></div>
                        <div><label>New Password ⠀⠀⠀⠀⠀⠀</label><input name="password" id="password" type="password" onkeyup='check();' required pattern="\d{8,20}" /><br></div>
                        <div><label>Re-type New Password ⠀⠀⠀⠀⠀⠀</label><input type="password" name="confirm_password" id="confirm_password" onkeyup='check();' pattern="\d{8,20}" required /> <br></div>
                        <div> <span id='message'></span><br> </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" href="/">Submit</button>
            <button> <a href="index.php">back to homepage</a> </button>
        </form>
    </div>
</body>
</html>