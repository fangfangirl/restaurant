<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])){
    if(isset($_POST["name"])) $name = $_POST["name"]; else $name = "";
    if(isset($_POST["email"])) $email = $_POST["email"]; else $email = "";
    if(isset($_POST["tel"])) $tel = $_POST["tel"]; else $tel = "";
    if(isset($_POST["nameres"])) $nameres = $_POST["nameres"]; else $nameres = "";
    $password = $_POST["password"];
    updateData($name, $nameres, $email, $tel, $password, $conn);
 }

function updateData($name, $nameres, $email, $tel, $password, $conn)
{
    $username = $_SESSION['id_r'];
    $sql = "SELECT * FROM user_restaurant WHERE username_res='$username' and password='$password'";
    $res = mysqli_query($conn,$sql); //查询结果保存在$res对象中
    $db_password = NULL;
    while($row1 = mysqli_fetch_assoc($res))
    {
        $db_password = $row1['password'];
    }
    if(is_null($db_password))
    {
        alert2('輸入舊密碼錯誤，請重新確認','../view/update_ResAccount.php');
    }
    if( $name != "" )
    {
        $update="UPDATE user_restaurant SET bossname='$name' WHERE username_res='$username'";
        mysqli_query($conn,$update);
    }
    if( $tel != "" )
    {
        $update1="UPDATE user_restaurant SET telephone='$tel' WHERE username_res='$username'";
        mysqli_query($conn,$update1);
    }
    if( $email != "" )
    {
        $update2="UPDATE user_restaurant SET email='$email' WHERE username_res='$username'";
        mysqli_query($conn,$update2);
    }
    if( $nameres != "" )
    {
        $update3="UPDATE user_restaurant SET name='$nameres' WHERE username_res='$username'";
        mysqli_query($conn,$update3);
    }
    alert2('修改成功','../view/index2.php');
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