<?php
require_once 'config.php';
session_start();
if (isset($_POST['submit'])){

   $query = [
    'nameuser' => htmlspecialchars($_POST["nameuser"]),
    'account' => htmlspecialchars($_POST["account"]),
    'password' => htmlspecialchars($_POST["password"]), 
    'again' => htmlspecialchars($_POST["password2"]),
    'email' => htmlspecialchars($_POST["email"]),
    'phone' => htmlspecialchars($_POST["phonenum"])
   ];
   //$conn = mysqli_connect("localhost", "root", "","group9"); 
   updateData($query['nameuser'], $query['account'], $query['password'], $query['again'], $query['email'],$query['phone'], $conn);
}

function updateData($nameuser, $account, $password, $again, $email, $phone, $conn)
{
    $sql = "SELECT * FROM user_customer WHERE username_cus = '$nameuser'";
    $result = mysqli_query($conn,$sql);
    $db_username=NULL;
    $db_password=NULL;
    while($row = mysqli_fetch_assoc($result))
    {
        $db_username = $row['username_cus'];
        $db_password = $row['password'];
    }
    if(!is_null($db_username))
    {
        alert2('此帳號已註冊，請更換新的','../view/register.php');
    }
    else
    {
        $sql3 = "INSERT INTO user_customer VALUES ('$nameuser', '$account', '$password', '$email', '$phone')";
        mysqli_query($conn,$sql3);
        $sql2 = "SELECT * FROM user_customer WHERE username_cus = '$account'AND password = '$password'";
        $result2 = mysqli_query($conn,$sql2);
        $row5 = mysqli_fetch_assoc($result2);
        $_SESSION['login_c']=true;
        $_SESSION['id_c']=$row5["username_cus"];
    }
}

if (isset($_POST['submit'])){

    $username_cus = htmlspecialchars($_POST["account"]);
    if($_FILES['form_data']['error'] === UPLOAD_ERR_OK)
    {        
        $form_data_name = $_FILES['form_data']['name'];
        $form_data_size = $_FILES['form_data']['size'];
        $form_data_type = $_FILES['form_data']['type'];
        $form_data = $_FILES['form_data']['tmp_name'];
        $data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
        echo"<script>alert('非預設');</script>";
        $flag1 =1;
    }
    else{
        $form_data_type = 'image/jpg';
        $temp = fopen('unsplash2.jpg', "r");
        $data = addslashes(fread($temp, filesize('unsplash2.jpg')));
        $form_data_name = 'unsplash2.jpg';
        $form_data_size = filesize('unsplash2.jpg');
        echo"<script>alert('預設');</script>";
        $flag1 = 0;
    }
    //echo "mysqlPicture=".$data;
    /*$sql4 = "SELECT * FROM imgpic_c WHERE username_cus = '$username_cus'";
    $result4 = mysqli_query($conn,$sql4);
    $db_username4=NULL;
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $db_username4 = $row4['username_res']; 
    }
    if(is_null($db_username4))
    {*/
    $result = $conn->query("INSERT INTO imgpic_c (username_cus,bin_data,filename,filesize,filetype)VALUES ('$username_cus', '$data','$form_data_name','$form_data_size','$form_data_type')");
        //echo"<script>alert('餐廳圖片已儲存到資料庫');</script>";
    /*}
    else if(!is_null($db_username4) && $flag1 == 1)
    {
        $sql5 = "UPDATE imgpic SET bin_data='$data', filename='$form_data_name', filesize='$form_data_size', filetype='$form_data_type'  WHERE username_res = '$name1' and description = '餐廳' ";
        $result = mysqli_query($conn,$sql5);
        //echo"<script>alert('餐廳圖片修改資料庫');</script>";
    }*/
    alert2('註冊成功','../view/index2.php');

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