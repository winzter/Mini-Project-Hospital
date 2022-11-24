<?php
$pdo = new PDO("mysql:host=localhost;dbname=system_hospital;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
$name = "%" . $_GET["name"] . "%";
$stmt = $pdo->prepare("select dfnamelname,dspec from doctor where dfnamelname like ?");
$stmt->bindParam(1, $name);
$stmt->execute();


if ($stmt->rowCount() > 0) { ?>
    <table border="1" style="margin: 0 auto;">
        <tr>
            <th>ขื่อ-นามสกุล</th>
            <th>ด้านที่เชี่ยวชาญ</th>
        </tr>
        <?php while ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?= $row['dfnamelname'] ?></td>
                <td><?= $row['dspec'] ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>