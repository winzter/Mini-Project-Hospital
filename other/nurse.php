<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
$name = "%" . $_GET["name"] . "%";
$stmt = $pdo->prepare("select nfnamelname,nposition from nurse where nfnamelname like ?");
$stmt->bindParam(1, $name);
$stmt->execute();


if ($stmt->rowCount() > 0) { ?>
    <table border="1" style="margin: 0 auto;">
        <tr>
            <th>ขื่อ-นามสกุล</th>
            <th>ตำแหน่ง</th>
        </tr>
        <?php while ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?= $row['nfnamelname'] ?></td>
                <td><?= $row['nposition'] ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>