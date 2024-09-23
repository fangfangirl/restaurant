<?php
require_once 'config.php';
session_start();

if (isset($_POST['action2'])){
  $star = $_POST['star'];
  $comment = $_POST['comment'];
  $restaurant = $_POST['username_res_star'];//看那時候是哪一家
  $customer = $_SESSION['id_c'];
  //echo"<script>alert('$star');</script>";
  checkData($restaurant, $customer, $comment, $star, $conn);
}

function checkData($restaurant, $customer, $comment, $star, $conn)
{
  $sql1 = "SELECT * FROM comment WHERE username_res = '$restaurant' AND username_cus = '$customer' ";
  $result1 = mysqli_query($conn, $sql1);

  if(mysqli_num_rows($result1)==0)
  {
    //echo"<script>alert('$restaurant');</script>";
    $sql = "INSERT INTO comment 
    VALUES ('$restaurant', '$customer', '$comment', '$star')";
    mysqli_query($conn,$sql);
    $url = "../view/restaurant_view.php?username_res=$restaurant";
    alert1('評論成功',$url);
    
  }else{
    $sql = "UPDATE comment 
            SET comment='$comment', star='$star'
            WHERE username_res = '$restaurant' AND username_cus = '$customer'";
    mysqli_query($conn,$sql);
    $url = "../view/restaurant_view.php?username_res=$restaurant";
    alert1('修改成功',$url);
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
