<?php
require_once 'config.php';
session_start();

if (isset($_POST['action1'])){
    $query = [
     'booknum' => $_POST["booknum"],
     'bookdate' => $_POST["bookdate"],
     'booktime' => $_POST["booktime"],
     'booknote' => $_POST["booknote"]
    ];
    $restaurant = $_POST["restaurant_book"];
    //echo"<script>alert('哇哇哇 : $restaurant');</script>";
    $customer = $_SESSION['id_c'];
    if(empty($query['booknote'])) $query['booknote'] = "無"; 
    checkData($restaurant, $customer, $query['booknum'], $query['bookdate'], $query['booktime'], $query['booknote'], $conn);
    

}

function checkData($bookres, $bookcus, $booknum, $bookdate, $booktime, $booknote, $conn)
{
  //echo"<script>alert('有近來第二個');</script>";

  //$username_res = $_POST['username'];

  $sql = "SELECT capacity, opening , closing FROM intro_res WHERE username_res = '$bookres'";	
  $result = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_assoc($result))	
  {	
    $capacity = $row['capacity'];		
    $opening = $row['opening'];		
    $closing= $row['closing'];
  }

  $index = -1;
  $sql2 = "SELECT * 
            FROM booklist 
            WHERE username_res = '$bookres' AND username_cus = '$bookcus' AND booktime ='$booktime' AND date = '$bookdate' ";	
  $result2 = mysqli_query($conn,$sql2);
  while ($row2 = mysqli_fetch_assoc($result2))	
  {		
    $index = 0;	
  }

  $sql1 = "SELECT SUM(number) AS sum
            FROM booklist 
            WHERE username_res = '$bookres' AND booktime ='$booktime' AND date = '$bookdate'";	
  $result1 = mysqli_query($conn,$sql1);
  while ($row1 = mysqli_fetch_assoc($result1))	
  {		
    $sum_num = $row1['sum'] + $booknum;		
  }
  //echo"<script>alert('$sum_num');</script>";
  $url_res="../view/restaurant_view.php?username_res=$bookres";
  $url_change="../view/update_CusReservation.php";
  if($index == 0)
  {
      alert1('已經有定位資訊了',$url_change);
  }
  else if($opening > $booktime || $closing <= $booktime)
    alert1('請選擇營業時間訂位，我們將導向該餐廳總介紹',$url_res);
  else if($capacity <= $sum_num)
    alert1('非常抱歉，該時間段我們訂位數已滿，請選擇其他時間',$url_res);
  else{
    $sql3 = "INSERT INTO booklist VALUES ('$bookres', '$bookcus', '$booknum', '$bookdate', '$booktime', '$booknote')";
    mysqli_query($conn,$sql3);
    alert1('訂位成功','../view/reservation_info.php');
  }

}
function alert1($message,$address)
{
    echo"<script>
    alert('$message');
    location.href='$address';
    </script>";
    return false;
}

mysqli_close($conn);
?>
