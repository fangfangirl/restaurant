<?php
require_once 'config.php';
session_start();

if (isset($_POST['action'])){
   $query = [
    'name' => htmlspecialchars($_POST["nameres"]),
    'owner' => htmlspecialchars($_POST["owner"]),
    'account' => htmlspecialchars($_POST["accountres"]),
    'password' => htmlspecialchars($_POST["passwordres"]), 
    'again' => htmlspecialchars($_POST["password2res"]),
    'email' => htmlspecialchars($_POST["email_res"]),
    'phone' => htmlspecialchars($_POST["phone_res"])
   ];
   //$conn = mysqli_connect("localhost", "root", "","group9"); 
   updateData($query['name'], $query['owner'], $query['account'], $query['password'], $query['again'], $query['email'],$query['phone'], $conn);
}

function updateData($name, $owner, $account, $password, $again, $email, $phone, $conn)
{
    $sql = "SELECT * FROM user_restaurant WHERE username_res = '$account'";
    $sql4 = "SELECT * FROM user_restaurant WHERE name = '$name'";
    $result = mysqli_query($conn,$sql);
    $result4 = mysqli_query($conn,$sql4);
    $db_username=NULL;
    $db_password=NULL;
    $db_name=NULL;
    while($row = mysqli_fetch_assoc($result))
    {
        $db_username = $row['username_res'];
        $db_password = $row['password'];
    }
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $db_name = $row4['name'];
    }
    if(!is_null($db_name))
    {
        alert2('該餐廳已註冊過，請登入','../view/login.php');
    }
    else if(!is_null($db_username))
    {
        alert2('此帳號已註冊，請更換新的','../view/register.php');
    }
    else
    {
        $sql3 = "INSERT INTO user_restaurant VALUES ('$name', '$owner', '$account', '$password', '$email', '$phone')";
        mysqli_query($conn,$sql3);
        $sql2 = "SELECT * FROM user_restaurant WHERE username_res = '$account'AND password = '$password'";
        $result2 = mysqli_query($conn,$sql2);
        $row5 = mysqli_fetch_assoc($result2);
        $_SESSION['login_r']=true;
        $_SESSION['login_check']=true;
        $_SESSION['id_r']=$row5["username_res"];
        alert2('註冊成功','../view/update_ResInfo.php');
    }
}
function alert2($message,$address)
{
    echo"<script>alert('$message');
    location.href='$address';
    </script>";
    return false;
}
mysqli_close($conn);
?>