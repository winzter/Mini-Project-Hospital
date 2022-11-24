
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/index.css">
    <script>
        var xmlHttp;
        function send() {
            xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = showResult;
            var name = document.getElementById("name").value;
            var url = "doctor.php?name=" + name;
            xmlHttp.open("GET",url,true);
            xmlHttp.send();
        } 
        function showResult()
        {
            if(xmlHttp.readyState == 4)
            {
                if(xmlHttp.status == 200)
                {
                    document.getElementById("result").innerHTML = xmlHttp.responseText;
                }
            }
        }
    </script>
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
        #home{
            float:right;
        }
        span{
            font-weight: bold;
            font-size: 1.5rem;
        }
        input{
            padding: 5px;
            font-size: 1rem;
        }
        
    </style>
</head>

<body>
    <?php include './nav.php' ?>
    <div style="padding: 10px;">
        <a href="doctorform.php">หมอ</a> | 
        <a href="nurseform.php">พยาบาล</a>
        <br>
    </div>
    <div style="padding: 0 10px 10px; text-align: center;">
        <span>ค้นหาชื่อแพทย์ :</span> 
        <input type="text" id="name" onkeyup="send()" pattern="[A-Za-z]+"
         placeholder="Search for doctors..." title="Please enter only alphabet">
    </div>
    
    <div id="result"></div>
</body>

</html>