<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://kit.fontawesome.com/d711d18929.js" crossorigin="anonymous"></script>
    <script>
        async function getDataFromAPI() {
            let response = await fetch('https://data.go.th/dataset/8d33e225-1a96-401b-ae0b-f3fa683cabdd/resource/09bf9c0a-b066-420c-8af2-2169657694ad/download/gov_hos.json')
            let rawData = await response.text()
            let objectData = JSON.parse(rawData)
            let result = document.getElementById('result')

            for (let i = 0; i < objectData.features.length; i++) {
                console.log(objectData.features[i].id)
                if (objectData.features[i].id =='gov_hos.4'){
                    let content = objectData.features[i].properties.name 
                    let bed_hos = 'มีทั้งหมด '+objectData.features[i].properties.num_bed + ' เตียง'
                    let add_hos = 'ที่อยู่ : ' +objectData.features[i].properties.address
                    let tel_hos = 'เบอร์ติดต่อ : ' +objectData.features[i].properties.tel
                let h4 = document.createElement('h4')
                h4.innerHTML = content
                result.appendChild(h4) 

                let li = document.createElement('li')
                li.innerHTML =  bed_hos
                result.appendChild(li)

                let li2 = document.createElement('li')
                li2.innerHTML =  add_hos
                result.appendChild(li2)

                let li3 = document.createElement('li')
                li3.innerHTML =  tel_hos
                result.appendChild(li3)

                }       
            }
        }
        getDataFromAPI() // เรียกฟังก์ชัน
    </script>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <header class="header">
        <a href="./index.php"><img src="img/logo.png" alt="logo" width="100" height="100"></a>
        <h2>Rajavithi Hospital </h2>
    </header>

    <!-- <nav class="topnav">
        <a href="doctor/loginD.php">Doctor</a>
        <a href="nurse/loginN.php">Nurse</a>
        <a href="other/doctorform.html" style="float:right">Medical personal</a>
    </nav> -->
    <?php include './nav.php' ?>

    <section class="row">
        <div class="leftcolumn">
            <div class="card">
                <h2>โรงพยาบาลราชวิถี กรมการแพทย์</h2>
                <h5>Nov 25, 2022</h5>
                <div class="fakeimg">
                    <img src="img/hos1.jpg" width="100%" height="auto">
                </div>
                <div class="history">
                    <h2>ประวัติโดยย่อ</h2>
                    <p>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀โรงพยาบาลราชวิถี ก่อตั้งเมื่อวันที่ 16 เมษายน พ.ศ. 2494 โดยใช้ชื่อว่า "โรงพยาบาลหญิง"
                        ในรัฐบาลจอมพล ป.พิบูลสงคราม เพื่อให้เป็น
                        โรงพยาบาลเฉพาะสตรีและเด็ก เป็นแห่งแรกของประเทศไทย อำนวยการโดยนายแพทย์ประพนธ์ เสรีรัตน์
                        ดำรงตำแหน่ง รักษาการผู้อำนวยการ
                        และอีกเดือนต่อมา นายแพทย์เสม พริ้งพวงแก้ว ได้รับแต่งตั้งให้เป็น ผู้อำนวยการโรงพยาบาล
                        และได้รับความไว้วางใจในการเข้าการรักษาจากประชาชนจำนวนมาก
                        โดยเฉพาะเมื่อการผ่าตัดแฝดสยาม วันดี ศรีวัน แยกออกจากกันสำเร็จ เป็นครั้งแรกในประเทศไทย
                        ได้สร้างชื่อเสียงให้กับโรงพยาบาลอย่างมาก</p>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <aside class="card map">
                <h2>About Us</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.2415405941374!2d100.5346069145081!3d13.764302390339397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29eb3c30dc06f%3A0x4a136845b50ee1b9!2z4LmC4Lij4LiH4Lie4Lii4Liy4Lia4Liy4Lil4Lij4Liy4LiK4Lin4Li04LiW4Li1!5e0!3m2!1sth!2sth!4v1667552826166!5m2!1sth!2sth"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                
            </aside>

            <aside class="card">
               <p id="result"></p> 
            </aside> 

            <aside class="card">
                <h3>Follow Me</h3>
                <p> <i class="fa-brands fa-facebook"></i> : click <a href="https://www.facebook.com/PR.Rajavithi/"
                        target="_black"> facebook</a> </p>
                <p> <i class="fa-brands fa-youtube"></i> : click <a
                        href="https://www.youtube.com/channel/UC7bX792qKQxrHNwoG68apZA" target="_black"> youtube </a></p>
            </aside>
        </div>
    </section>

    <footer class="footer">
        <h2>Contact</h2>
        <i class="fa-regular fa-envelope"> crm@rajavithi.go.th</i><br>
        <i class="fa-solid fa-phone-volume"> 02 206 2900</i>
    </footer>

</body>

</html>