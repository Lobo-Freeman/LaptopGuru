<?php 
require_once 'db_connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE user_id = $id";
$sqlAddress = "SELECT * FROM address WHERE user_id = $id";

$resultAddress = $conn->query($sqlAddress);
$result = $conn->query($sql);

$user = $result->fetch_assoc();
$address = $resultAddress->fetch_all(MYSQLI_ASSOC);




?>


<?php foreach($address as $row): ?>
<tr>
    <th>地址</th>
    <td>
        <?=$row['country']?><?=$row['city']?><?=$row['strict']?><?=$row['remained_address']?>
    </td>
</tr>
<?php endforeach; ?>