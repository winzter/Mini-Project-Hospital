<?php 
    session_start();
    if(!empty($_SESSION['username'])){
        header("location: index.php");
    } 
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            padding: 0;
            background: #f1f1f1;
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
        img{
            align-content: center;
        }
    </style>
</head>

<body>

    <nav class="topnav">
        <a href="../index.php">Home</a>
        <a href="../doctor/loginD.php">Doctor</a>
        <a href="../nurse/loginN.php">Nurse</a>
        <a href="../other/doctorform.php" style="float:right">Medical Personal</a>
    </nav>

    <form action="check-loginN.php" method="post">
        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
            <div class="relative bg-white pt-10 pb-8 px-10 shadow-xl mx-auto w-96 rounded-lg">
                <div class="divide-y divide-gray-300/50 w-full">
                    <div class="space-y-6 py-8 text-base  text-gray-600">
                        <img src="../img/nurse.png" alt="nurse" width="50%" style="margin: 0 auto;">
                        
                        <p class="text-xl font-medium leading-7" style="text-align: center;">Nurse</p>
                        <div class="space-y-4 flex flex-col">
                            <input type="text" name="username" placeholder="Username" class="border border-gray-300/50 p-1 rounded focus:outline-none" required />

                            <input type="password" name="password" placeholder="Password" class="border border-gray-300/50 p-1 rounded focus:outline-none" required />
                        </div>
                    </div>
                    <?php if (isset($_GET['message'])) : ?>
                            <p class="text-sm text-red-500"><?= $_GET['message']; ?></p>
                        <?php endif; ?>
                    <div class="pt-6 text-base font-semibold leading-7">
                        <button type="submit" class="bg-pink-500 hover:bg-pink-600 px-4 py-1 text-white rounded">
                            Login
                        </button><br>
                    </div>
                </div>
            </div>
        </div>
    </form>


</body>

</html>