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
    
        $sql3 = "INSERT INTO help_check VALUES ('$name', '$tel', '$feedback')";
        mysqli_query($conn,$sql3);
        alert2('謝謝，我們已收到您的訊息','https://getform.io/thank-you?id=f5781ce8-a6f2-406d-bde3-57b1b50da340');

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