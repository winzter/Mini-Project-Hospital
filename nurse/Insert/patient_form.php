<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location: ../loginN.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');
        body{
            font-family: 'Kanit', sans-serif;
            background-color: #f9f9f9;
        }  
        
        .container{
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            width: 20%;
            margin: 5vh auto;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            
        }
        .contain {
            padding: 20px 250px;
            display: flex;
            flex-direction: column;
        }

        .bottom {
            margin-bottom: 5px;
        }

        .back {
            text-align: center;
            width: 2vw;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background: pink;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .back:hover {
            background: palevioletred;
        }

        i{
            cursor: pointer;
            color: #FFADBC;
        }
        i:hover{
            color: #975C8D;
        }
        label{
            font-size: 20px;
            font-weight: 1000;
        }

        input:focus{
            outline: none;
        }

        input{
            padding: 5px;
        }

        .btn {
            cursor: pointer;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 auto;
            border-radius: 5px;
            border: none;
            background: #FFADBC;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .btn:hover {
            background: palevioletred;
        } 

        input[type=submit]{
            border-radius: 5px;
            padding: 13px 20px;
            cursor: pointer;
            background-color: #FFADBC;
            border: none;
            color: white;
        }

        input[type=submit]:hover{
            background-color: #975C8D;
        }
        

        .sex{
            margin-left: 3vw;
        }

        .btncontainer{
            text-align: center;
            margin: 5vh 0 auto;
        }
        
    </style>
    <script>
        function removeTel() {
            try {
                let tel = document.getElementById("tel");
                tel.removeChild(tel.lastChild);
            } catch (err) {
                console.log(err);
            }

        }

        function addTel() {
            let input = document.createElement("INPUT");
            input.setAttribute("type", "tel");
            input.setAttribute("name", "phone[]");
            input.setAttribute("required", "");
            input.pattern = "[0-9]{10}";
            document.getElementById("tel").appendChild(input).style.display = "block";
        }

        function addDisease() {
            let input = document.createElement("INPUT");
            input.setAttribute("type", "text");
            input.setAttribute("name", "d[]");
            document.getElementById("diseases").appendChild(input).style.display = "block";
        }

        function removeDisease() {
            try {
                let disease = document.getElementById("diseases");
                disease.removeChild(disease.lastChild);
            } catch (err) {
                console.log(err);
            }
        }
    </script>
    <title>Document</title>
</head>

<body>
    <?php include './nav.php' ?>
    <h1 style="text-align: center; margin-top: 3vh;">Add Patient</h1>
    <form action="insert_patient.php" method="post">
        <div class="container">
            <div class="firstlastname">
                <label for="name">First Name </label>
                <input type="text" id="name"  pattern="[\DA-Za-z]{1,}" name="fname" required title="First name must contain characters a - z , A-Z only!"><br>
                <label for="name">Last Name </label>
                <input type="text" id="name" pattern="[\DA-Za-z]{1,}" name="lname" required title="Last name must contain characters a - z , A-Z only!">
            </div>

            <div class="form">
                <label for="dob">Date Of Birth </label>
                <input type="date" name="dob" id="dob" required><br>
            </div>

            <div class="form">
                <label>Sex</label>
                <div class="sex">
                    <div>
                        <input type="radio" name="sex" id="male" value="MALE" required>
                        <label for="male">Male</label>
                    </div>

                    <div>
                        <input type="radio" name="sex" id="female" value="FEMALE" required>
                        <label for="male">Female</label><br>
                    </div>
                </div>
            </div>

            <div class="form">
                <label for="contract">Contract</label>
                <div>
                    <input type="tel" name="phone[]" id="phone1" required pattern="\d{10}" title="Phone number must contain 0-9 only!">
                    <span onclick="addTel()"><i class="fa-solid fa-square-plus"></i></span>
                    <span onclick="removeTel()"><i class="fa-solid fa-square-minus"></i></span>
                </div>
            </div>
            <div id="tel"></div>

            <div class="form">
                <label for="disease">Diseases</label>
                <div>
                    <input type="text" id="diseaseInput" name="d[]">
                    <span onclick="addDisease()"><i class="fa-solid fa-square-plus"></i></span>
                    <span onclick="removeDisease()"><i class="fa-solid fa-square-minus"></i></span>
                </div>
            </div>
            <div id="diseases"></div>
            <div class="btncontainer">
                <a class="btn" href="../index.php">Back</a>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>