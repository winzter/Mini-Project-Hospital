<?php
    session_start();
    if(empty($_SESSION['username'])){
       header("location: ../loginN.php");
    }
    $pid = $_GET['pid'];
    $sex = $_GET['sex'];
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $pInfo = $pdo->prepare("SELECT * FROM patient WHERE pid = ?");
        $pInfo->bindParam(1,$pid);
        $pInfo->execute();
        $info = $pInfo->fetch();

        if(str_contains($info['pfnamelname']," ")){
            $fnamelname = explode(" ",$info['pfnamelname']);
        }

        $pTel = $pdo->prepare("SELECT * FROM ptel WHERE pid = ? ORDER BY pnumber DESC");
        $pTel->bindParam(1,$pid);
        $pTel->execute();
        

        $pDisease = $pdo->prepare("SELECT pdisease FROM disease WHERE pid = ? ORDER BY pdisease DESC");
        $pDisease->bindParam(1,$pid);
        $pDisease->execute();
        $checkDisease = array();
        while($row = $pDisease->fetch()){
            array_push($checkDisease,$row['pdisease']);
        }

        $date = $pdo->prepare("SELECT DISTINCT entrydate , leavedate FROM seeadoctor WHERE pid = ?");
        $date->bindParam(1,$pid);
        $date->execute();
        $pdate = $date->fetch();
    }
    catch(PDOException $e){
        echo "Connection Fail : ".$e;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script>
        window.onload = ()=>{
            if("<?=$info['psex']?>" == "MALE") {
                document.getElementById("male").checked = true;
            }else if ("<?=$info['psex']?>" == "FEMALE"){
                document.getElementById("female").checked = true;
            }
        }

        let request = new XMLHttpRequest();
        let requestDis = new XMLHttpRequest();

        function addTel() {
            let input = document.createElement("INPUT");
            let div = document.createElement("div");
            let icon = document.createElement("i");
            let span = document.createElement("span");

            icon.setAttribute("class","fa-solid fa-square-minus");
            span.setAttribute("onclick","removeTel()");
            input.setAttribute("type", "tel");
            input.setAttribute("name", "New[]");
            input.setAttribute("required", "");
            input.pattern = "[0-9]{10}";

            span.appendChild(icon);
            span.style.marginLeft = "4px";
            div.appendChild(input).style.display = "inline-block";
            div.appendChild(span);
            document.getElementById("tel").appendChild(div);
        }

        function remove(tel){
            let pid = "<?=$pid?>";
            if(confirm("Do you want to remove number : "+tel+" ?")){
                console.log(tel);
                request.onreadystatechange = ()=>{
                    if(request.readyState == 4 && request.status == 200){
                        let tele = document.getElementById("tel");
                            Array.from(tele.children).forEach(e=>{
                                console.log(e);
                                if(e.className == tel){
                                    tele.removeChild(e);
                                }
                            });
                    }
                }
                let url = "delete_patient.php?pid="+pid+"&tel="+tel;
                request.open("GET",url);
                request.send();
            }
        }

        function removeTel(){
            try{
                document.getElementById("tel").removeChild(document.getElementById("tel").lastElementChild);
            }
            catch(err){
                console.log(err);
            }
        }

        function addDes() {
            let input = document.createElement("INPUT");
            let div = document.createElement("div");
            let icon = document.createElement("i");
            let span = document.createElement("span");
            
            icon.setAttribute("class","fa-solid fa-square-minus");
            span.setAttribute("onclick","removeDis()");
            input.setAttribute("type", "text");
            input.setAttribute("name", "NewD[]");
            input.setAttribute("required", "");
            
            span.appendChild(icon);
            span.style.marginLeft = "4px";
            div.appendChild(input).style.display = "inline-block";
            div.appendChild(span);
            document.getElementById("diseases").appendChild(div);
        }

        function removeD(dis){
            try{
                let pid = "<?=$pid?>";
                if(confirm("Do you want to remove disease : "+dis+" ?")){
                    requestDis.onreadystatechange = ()=>{
                        if(requestDis.readyState == 4 && requestDis.status == 200){
                            let disease = document.getElementById("diseases");
                                Array.from(disease.children).forEach(e=>{
                                    if(e.className == dis){
                                        disease.removeChild(e);
                                    }
                                });
                        }
                    }
                    let url = "delete_patient.php?pid="+pid+"&dis="+dis;
                    requestDis.open("GET",url);
                    requestDis.send();
                }
            }
            catch(err){
                console.log(err);
            }
        }

        function removeDis(){
            try{
                document.getElementById("diseases").removeChild(document.getElementById("diseases").lastElementChild);
            }
            catch(err){
                console.log(err);
            }
        }

        
    </script>
    <link rel="stylesheet" href="../../css/editpatient.css">
    <title>Edit Patient</title>
</head>
<body>
    <?php include './nav.php' ?>
    <h1>Edit Patient</h1>
    <div class="form">

        <form action="update_patient.php" method="get">

            <div style="text-align: center;">
                <img src="../../img/patient/<?=$sex?>.png" alt="<?=$sex?>" width="200vw">
            </div>

            <div>

                <input type="text" name="pid" value="<?=$pid?>" hidden>

                <label for="name">Name&nbsp;</label>
                <div style="margin-right: 10px;">
                    <input type="text" id="name" pattern="[\DA-Za-z]{1,}" name="fname" required value="<?=$fnamelname[0]?>"><br>
                    <small>First Name</small>
                </div> 
                <div>
                    <input type="text" id="name" pattern="[\DA-Za-z]{1,}" name="lname" required value="<?=$fnamelname[1]?>"><br>
                    <small>Last Name</small><br>
                </div>
            </div>

            <div>
                <label for="dob">Date Of Birth&nbsp;</label>
                <input type="date" name="dob" id="dob" required value="<?=$info['pdob']?>"><br>
            </div>

            <div>
                <label>Sex :&nbsp;</label><br>
                <input type="radio" name="sex" id="male" value="MALE" required>
                <label for="male">Male</label>
                <input type="radio" name="sex" id="female" value="FEMALE" required>
                <label for="female">Female</label><br>
            </div>

            <div class="con-contact">
                <label for="contract">Contract&nbsp;</label>
                <span onclick="addTel()"><i class="fa-solid fa-square-plus"></i></span>
                <br>
                <div id="tel">
                    <?php while($row=$pTel->fetch()) :?>
                        <div class="<?=$row['pnumber']?>">
                            <input type="tel" name="phone[]" id="phone1" required pattern="\d{10}" value="<?=$row['pnumber']?>">
                            <span onclick="remove('<?=$row['pnumber']?>')"><i class="fa-solid fa-square-minus"></i></span>
                        </div>
                    <?php endwhile ?>
                </div>
            </div>

            <div>
                <label for="disease">Diseases&nbsp;</label>
                <span onclick="addDes()"><i class="fa-solid fa-square-plus"></i></span>
                <br>
                <div id="diseases">
                    <?php foreach($checkDisease as $d) {?>
                        <div class="<?=$d?>">
                            <input type="text" name="d[]" id="disease" value="<?=$d?>" required>
                            <span onclick="removeD('<?=$d?>')"><i class="fa-solid fa-square-minus"></i></span>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div>
                <label for="leavedate">Leave Date</label>
                <input type="date" name="date" id="leavedate" value="<?=$pdate['leavedate']?>">
            </div>
            <div style="text-align: center;">
                <input type="submit" value="Submit">
            </div>
            
        </form>
    </div>
</body>
</html>