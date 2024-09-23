<?php
require_once 'config.php';
session_start();

if (isset($_POST['action1'])){
    $query1 = [
      'booknum' => $_POST["number_old"],
      'bookdate' => $_POST["date_old"],
      'booktime' => $_POST["time_old"],
      'booknote' => $_POST["remark_old"]
    ]; 
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
    checkData($restaurant, $customer, $query1['booknum'], $query1['bookdate'], $query1['booktime'], $query1['booknote'], $query['booknum'], $query['bookdate'], $query['booktime'], $query['booknote'], $conn);
}

function checkData($bookres, $bookcus, $booknum_old, $bookdate_old, $booktime_old, $booknote_old, $booknum, $bookdate, $booktime, $booknote, $conn)
{
  //看店家開門時間
  $sql = "SELECT capacity, opening , closing FROM intro_res WHERE username_res = '$bookres'";	
  $result = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_assoc($result))	
  {	
    $capacity = $row['capacity'];		
    $opening = $row['opening'];		
    $closing= $row['closing'];
  }

 $index = -1;
  //看新時段有沒有訂位過
  if(($bookdate != $bookdate_old) || ($booktime != $booktime_old))
  {
   
    $sql2 = "SELECT * 
              FROM booklist 
              WHERE username_res = '$bookres' AND username_cus = '$bookcus' AND booktime ='$booktime' AND date = '$bookdate' ";	
    $result2 = mysqli_query($conn,$sql2);
    while ($row2 = mysqli_fetch_assoc($result2))	
    {		
      $index = 0;	
    }
  }

  //看新時段客滿了嗎??
  $sql1 = "SELECT SUM(number) AS sum
            FROM booklist 
            WHERE username_res = '$bookres' AND booktime ='$booktime' AND date = '$bookdate'";	
  $result1 = mysqli_query($conn,$sql1);
  while ($row1 = mysqli_fetch_assoc($result1))	
  {		
    $sum_num = $row1['sum'] + $booknum - $booknum_old;		
  }

  //echo"<script>alert('$sum_num');</script>";
  $url_res="../view/restaurant_view.php?username_res=$bookres";
  $url_change = "../view/update_CusReservation.php?id_r=$bookres&number=$booknum_old&date=$bookdate_old&time=$booktime_old&remark=$booknote_old";
  if($index == 0)
  {
      alert1('已經有定位資訊了',$url_change);
  }
  else if($opening > $booktime || $closing <= $booktime)
    alert1('請選擇營業時間訂位，我們將導向該餐廳總介紹',$url_change);
  else if($capacity <= $sum_num)
    alert1('非常抱歉，該時間段我們訂位數已滿，請選擇其他時間',$url_change);
  else{
    $sql3 = "UPDATE booklist 
            SET date = '$bookdate', booktime = '$booktime', number = '$booknum', remark = '$booknote'
            WHERE username_res='$bookres' AND username_cus='$bookcus' AND date = '$bookdate_old' AND booktime = '$booktime_old' AND number = '$booknum_old' AND remark = '$booknote_old'";
    mysqli_query($conn,$sql3);
    unset($_SESSION['delete_book']);
    alert1('修改訂位成功','../view/reservation_info.php');
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
