<!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');
            body{
                margin: 0;
            }
            .navbar {
                padding: 0;
                overflow: hidden;
                background-color: palevioletred;
                font-family: 'Kanit', sans-serif;
            }

            .navbar a {
                float: left;
                font-size: 16px;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            .dropdown {
                float: right;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                cursor: pointer;
                font-size: 16px;  
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
            }

            .navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
                background-color: #ddd;
                color: black;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .show {
                display: block;
            }
        </style>
    </head>
    <body>

        <div class="navbar">
            <a href="../index.php">Home</a>
            <a href="loginD.php">Doctor</a>
            <a href="../nurse/loginN.php">Nurse</a>
            
            <div class="dropdown">
                <button class="dropbtn" onclick="myFunction()"><?=$_SESSION['fullnameD']?>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="./doctorinfo.php?did=<?=$_SESSION['usernameD']?>">Personal Information</a>
                    <a href="./changepassword.php?did=<?=$_SESSION['usernameD']?>">Change Password</a>
                    <a href="./logoutD.php">Log Out</a>
                </div>
            </div> 
            <a href="../other/doctorform.php" style="float: right;">Medical Personal</a>
        </div>
       

        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            window.onclick = function(e) {
                if (!e.target.matches('.dropbtn')) {
                    var myDropdown = document.getElementById("myDropdown");
                    if (myDropdown.classList.contains('show')) {
                        myDropdown.classList.remove('show');
                        }
                }
            }
        </script>
    </body>
</html>
