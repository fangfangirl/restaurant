<?php
require_once 'config.php';
session_start();

if (isset($_POST['action'])){
   $query = [
     'username' => htmlspecialchars($_POST["nameuser"]),
     'password' => htmlspecialchars($_POST["password"])
   ];
   //$conn = mysqli_connect("localhost", "root", "","group9"); 
   checkData($query['username'], $query['password'], $conn);
}

function checkData($username, $password, $conn)
{
   $sql = "SELECT username_res FROM user_restaurant WHERE username_res = '$username'AND password = '$password'";
   $result = mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)==0)
   {
      alert1('帳號或密碼輸入錯誤','../view/login.php');
   }
   else 
   {
      $sql2 = "SELECT * FROM user_restaurant WHERE username_res = '$username'AND password = '$password'";
      $result2 = mysqli_query($conn,$sql2);
      $row = mysqli_fetch_assoc($result2);
      $_SESSION['login_r']=true;
      $_SESSION['login_check']=false;
      $_SESSION['id_r']=$row["username_res"];
      alert1('登入成功','../view/res_home.php'); //這要連到老闆頁面   
    }
}
function alert1($message,$address)
{
    echo"<script>alert('$message');
    location.href='$address';
    </script>";
    return false;
}
//mysqli_close($conn);
?>