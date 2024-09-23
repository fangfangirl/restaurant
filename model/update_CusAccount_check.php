<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])){
    if(isset($_POST["name"])) $name = $_POST["name"]; else $name = "";
    if(isset($_POST["email"])) $email = $_POST["email"]; else $email = "";
    if(isset($_POST["tel"])) $tel = $_POST["tel"]; else $tel = "";
    $password = $_POST["password"];
    updateData($name, $email, $tel, $password, $conn);
}

if (isset($_POST['submit'])) {
    
    $name1 = $_SESSION['id_c'];
    if($_FILES['form_data']['error'] === UPLOAD_ERR_OK)
    {        
        $form_data_name = $_FILES['form_data']['name'];
        $form_data_size = $_FILES['form_data']['size'];
        $form_data_type = $_FILES['form_data']['type'];
        $form_data = $_FILES['form_data']['tmp_name'];
        $data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
        //echo"<script>alert('非預設');</script>";
        $flag1 =1;
    }
    else{
        $form_data_type = 'image/png';
        $temp = fopen('non_pic.png', "r");
        $data = addslashes(fread($temp, filesize('non_pic.png')));
        $form_data_name = 'non_pic.png';
        $form_data_size = filesize('non_pic.png');
        //echo"<script>alert('預設');</script>";
        $flag1 = 0;
    }
    //echo "mysqlPicture=".$data;
    
    $sql4 = "SELECT * FROM imgpic_c WHERE username_cus = '$name1'";
    $result4 = mysqli_query($conn,$sql4);
    $db_username4=NULL;
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $db_username4 = $row4['username_cus']; 
    }
    if(is_null($db_username4))
    {
        $result = $conn->query("INSERT INTO imgpic_c (username_cus,bin_data,filename,filesize,filetype)VALUES ('$name1', '$data','$form_data_name','$form_data_size','$form_data_type')");
        //echo"<script>alert('餐廳圖片已儲存到資料庫');</script>";
    }
    else if(!is_null($db_username4) && $flag1 == 1)
    {
        $sql5 = "UPDATE imgpic_c SET bin_data='$data', filename='$form_data_name', filesize='$form_data_size', filetype='$form_data_type'  WHERE username_cus= '$name1'  ";
        $result = mysqli_query($conn,$sql5);
        //echo"<script>alert('餐廳圖片修改資料庫');</script>";
    }
    alert2('修改成功','../view/index2.php');

}

function updateData($name, $email, $tel, $password, $conn)
{
    $username = $_SESSION['id_c'];
    $sql = "SELECT * FROM user_customer WHERE username_cus='$username' and password='$password'";
    $res = mysqli_query($conn,$sql); //查询结果保存在$res对象中
    $db_name = NULL;
    $db_tel = NULL;
    $db_email = NULL;
    $db_password = NULL;
    while($row1 = mysqli_fetch_assoc($res))
    {
        $db_name = $row1['name'];
        $db_tel = $row1['telephone'];
        $db_email = $row1['email'];
        $db_password = $row1['password'];
    }
    if(is_null($db_password))
    {
        alert2('輸入舊密碼錯誤，請重新確認','../view/update_CusAccount.php');
    }
    if( $name != "" )
    {
        $update="UPDATE user_customer SET name='$name' WHERE username_cus='$username'";
        mysqli_query($conn,$update);
    }
    if( $tel != "" )
    {
        $update1="UPDATE user_customer SET telephone='$tel' WHERE username_cus='$username'";
        mysqli_query($conn,$update1);
    }
    if( $email != "" )
    {
        $update2="UPDATE user_customer SET email='$email' WHERE username_cus='$username'";
        mysqli_query($conn,$update2);
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