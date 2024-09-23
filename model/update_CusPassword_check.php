<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])){
    $query = [
        'oldpassword' => htmlspecialchars($_POST["Oldpassword"]),
        'newpassword' => htmlspecialchars($_POST["Newpassword"]),
        'again' => htmlspecialchars($_POST["Againnewpassword"])
      ];
    updateData($query['oldpassword'], $query['newpassword'], $query['again'], $conn);
 }

function updateData($oldpassword, $newpassword, $again, $conn)
{
    $name = $_SESSION['id_c'];
    $sql = "SELECT * FROM user_customer WHERE username_cus='$name' and password='$oldpassword'";
    $res = mysqli_query($conn,$sql); //查询结果保存在$res对象中
    $db_password = NULL;
    while($row1 = mysqli_fetch_assoc($res))
    {
        $db_password = $row1['password'];
    }
    if(is_null($db_password))
    {
        alert2('輸入舊密碼錯誤，請重新確認','../view/update_CusPassword.php');
    }
    else if( $newpassword == $db_password )
    {
        alert2('新舊密碼不可以相等','../view/update_CusPassword.php');
    }
    else{
        $row = mysqli_fetch_array($res,MYSQLI_NUM); //把$res转换成索引数组
        $update="UPDATE user_customer SET password='$newpassword' WHERE username_cus='$name'";
        $res1=mysqli_query($conn,$update);
        alert2('修改成功，請重新登入','../view/logout_c.php');
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