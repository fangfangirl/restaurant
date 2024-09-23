<?php
require_once 'config.php';
session_start();

if (isset($_POST['action'])){
   $query = [
    'name' => htmlspecialchars($_POST["name"]),
    'tel' => htmlspecialchars($_POST["telres"]),
    'feedback' => htmlspecialchars($_POST["feedback"]),
   ];
   updateData($query['name'], $query['tel'], $query['feedback'], $conn);
}

function updateData($name, $tel, $feedback, $conn)
{
    $sql = "SELECT * FROM user_restaurant WHERE bossname = '$name'";
    $sql4 = "SELECT * FROM user_customer WHERE name = '$name'";
    $result = mysqli_query($conn,$sql);
    $result4 = mysqli_query($conn,$sql4);
    $db_username_r=NULL;
    $db_username_c=NULL;
    while($row = mysqli_fetch_assoc($result))
    {
        $db_username_r = $row['bossname'];
    }
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $db_username_c = $row4['name'];
    }
    if(!is_null($db_username_r) || !is_null($db_username_c))
    {
        $sql3 = "INSERT INTO help_check VALUES ('$name', '$tel', '$feedback')";
        mysqli_query($conn,$sql3);
        alert2('謝謝，我們已收到您的訊息','https://getform.io/thank-you?id=f5781ce8-a6f2-406d-bde3-57b1b50da340');
    }
    else
    {
        alert2('請輸入註冊時的名字，以方便我們連繫，謝謝','../view/help.php');
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