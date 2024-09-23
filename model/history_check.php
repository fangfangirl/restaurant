<?php
require_once 'config.php';
session_start();
//echo"<script>alert('有近來');</script>";

$date = $_POST['date'];
$username_res = $_SESSION['id_r'];
//echo"<script>alert('$date');</script>";

/*$sql = "SELECT * 
        FROM booklist 
        WHERE  username_res = '$bookres' AND date = '$bookdate' ";*/
$num = array(0,0,0,0,0,0,0,0,0,0,0,0,0);

for($i=0;$i<12;$i++){
    $time = $i+1;
    $sql = "SELECT SUM(number) AS sum  
            FROM booklist 
            WHERE date = '$date' AND booktime = '$time' AND username_res = '$username_res'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $num[$i] = empty($row['sum']) ? 0 : intval($row['sum']);
}

echo json_encode($num);

?>