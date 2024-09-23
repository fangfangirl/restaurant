<?php
require_once 'config.php';
session_start();
//echo"<script>alert('有近來');</script>";

$bookdate = $_POST['bookdate'];
$booknum = $_POST['booknum'];
$opening = $_POST['opening'];
$closing = $_POST['closing'];
$username_res = "xx8";

//echo"<script>alert('$bookdate,$booknum,$opening,$closing,$username_res');</script>";

//找到最大容量
$sql = "SELECT capacity FROM intro_res WHERE username_res= '$username_res'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$num_available = $row['capacity'];
//echo"<script>alert('$num_available');</script>";

//辨別現在輸入的人數在選定的日期，可以放置的時間

$sql = "SELECT booktime 
        FROM booklist
        WHERE booktime IN (
            SELECT booktime 
            FROM booklist
            WHERE date='$bookdate'
            GROUP BY booktime
            HAVING SUM(number) + $booknum <= $num_available )";

$result = mysqli_query($conn,$sql);
//$count = mysqli_num_rows($result);

$count = 0;

while($row = mysqli_fetch_assoc($result))
{
    $data = $row['booktime'];
	$count = $count +1;
}

//echo"<script>alert('$count');</script>";
?>



<?php
	$options = '<option value="" disabled selected>12356465</option>';

	while ($row = mysqli_fetch_assoc($result)) {
	  $options .= '<option value="' . $row['booktime'] . '">' . $row['booktime'] . '</option>';
	}
	
	echo $options; // 将生成的下拉选择菜单的选项作为响应返回给前端
	

?>


<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">

