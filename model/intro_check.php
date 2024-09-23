<?php
require_once 'config.php';
session_start();

if( isset($_SESSION["login_check"]) || $_SESSION["login_check"]===true)
{
    $_SESSION['login_check'] = false;
}

if (isset($_POST['action'])) {
    
    $name1 = $_SESSION['id_r'];
    $form_description = '餐廳';
    $form_number = 1;
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
    
    $sql4 = "SELECT * FROM imgpic WHERE username_res = '$name1' and description = '餐廳'";
    $result4 = mysqli_query($conn,$sql4);
    $db_username4=NULL;
    while($row4 = mysqli_fetch_assoc($result4))
    {
        $db_username4 = $row4['username_res']; 
    }
    if(is_null($db_username4))
    {
        $result = $conn->query("INSERT INTO imgpic (username_res,description,number,bin_data,filename,filesize,filetype)VALUES ('$name1', '$form_description', '$form_number', '$data','$form_data_name','$form_data_size','$form_data_type')");
        //echo"<script>alert('餐廳圖片已儲存到資料庫');</script>";
    }
    else if(!is_null($db_username4) && $flag1 == 1)
    {
        $sql5 = "UPDATE imgpic SET bin_data='$data', filename='$form_data_name', filesize='$form_data_size', filetype='$form_data_type'  WHERE username_res = '$name1' and description = '餐廳' ";
        $result = mysqli_query($conn,$sql5);
        //echo"<script>alert('餐廳圖片修改資料庫');</script>";
    }
}

if (isset($_POST['action'])) {

    $name2 = $_SESSION['id_r'];
    $form_description_m = '菜單';

    if(isset($_FILES['form_data_m']['name']))
    {
           $form_count_m = count($_FILES['form_data_m']['name']);
    }
    else $form_count_m = 1;

    //echo"<script>alert('非預設_m');</script>";

    $sql6 = "SELECT * FROM imgpic WHERE username_res = '$name2' and description = '菜單'";
    $result6 = mysqli_query($conn,$sql6);
    $db_username6=NULL;
    while($row6 = mysqli_fetch_assoc($result6))
    {
        $db_username6 = $row6['username_res']; 
    }

    if(is_null($db_username6)) $index = 0; //原來資料庫有嗎??沒有
    else $index = 1; //有

    $aaa=$_FILES['form_data_m']['name'][0];

    /*echo"<script>alert('$aaa');</script>";
    echo"<script>alert('$bbb');</script>";*/


    if(!empty($aaa))
    {
        $sql7 = "DELETE FROM imgpic WHERE username_res = '$name2' and description = '菜單' ";
        $result7 = mysqli_query($conn,$sql7);
        //echo"<script>alert('DELETE');</script>";
    }


    for($i=0;$i<$form_count_m;$i++)
    {
        if($_FILES['form_data_m']['error'][$i] === UPLOAD_ERR_OK)
        {
            $form_data_name_m = $_FILES['form_data_m']['name'][$i];
            $form_data_size_m = $_FILES['form_data_m']['size'][$i];
            $form_data_type_m = $_FILES['form_data_m']['type'][$i];
            $form_data_m = $_FILES['form_data_m']['tmp_name'][$i];
            $form_number = $i+1;
            $data_m = addslashes(fread(fopen($form_data_m, "r"), filesize($form_data_m)));
            //echo"<script>alert('非預設_m');</script>";
            $flag2 = 1;
            //echo"<script>alert('你OK嗎??');</script>";
        }
        else
        {
            $form_data_name_m = 'non_meun.png';
            $form_data_size_m = filesize('non_meun.png');
            $form_data_type_m = 'image/png';
            $form_number = 1;
            $temp_m = fopen('non_meun.png', "r");
            $data_m = addslashes(fread($temp_m, filesize('non_meun.png')));
            //echo"<script>alert('預設_m');</script>";
            $flag2 = 0;
            //echo"<script>alert('你AAAA嗎??');</script>";
        }
        //echo "mysqlPicture=".$data;
        //echo"<script>alert('$flag2+++++');</script>";
        //echo"<script>alert('$index+++++');</script>";
        if($flag2 == 0)
        {
            if($index == 0)
            {
                $result = $conn->query("INSERT INTO imgpic (username_res,description,number,bin_data,filename,filesize,filetype) VALUES ('$name2', '$form_description_m','$form_number', '$data_m','$form_data_name_m','$form_data_size_m','$form_data_type_m')");
                //echo"<script>alert('菜單圖片已儲存到資料庫');</script>";
                //echo"<script>alert('你BBBBB嗎??');</script>";
            }
        }
        else{
            $result = $conn->query("INSERT INTO imgpic (username_res,description,number,bin_data,filename,filesize,filetype) VALUES ('$name2', '$form_description_m','$form_number', '$data_m','$form_data_name_m','$form_data_size_m','$form_data_type_m')");
            //echo"<script>alert('菜單圖片已儲存到資料庫嗎??????');</script>";
            //echo"<script>alert('你CCCCC嗎??');</script>";
        }
    }
}


if (isset($_POST['action'])){

    if(isset($_POST["wheel"])) $wheel = $_POST["wheel"]; else $wheel = 0;
    if(isset($_POST["pet"])) $pet = $_POST["pet"]; else $pet = 0;
    if(isset($_POST["kid"])) $kid = $_POST["kid"]; else $kid = 0;
    if(isset($_POST["park"])) $park = $_POST["park"]; else $park = 0;
    if(isset($_POST["elevator"])) $elevator = $_POST["elevator"]; else $elevator = 0;
    if(isset($_POST["wifi"])) $wifi = $_POST["wifi"]; else $wifi = 0;
    if(isset($_POST["intro"])) $intro = $_POST["intro"]; else $intro = 0;
    $payment = $_POST["payment"];
    $payment = implode(" ",$payment);

    $query = [
        'location' => $_POST["location"],
        'type' => $_POST["type"],
        'capacity' => $_POST["capacity"],
        'opening' => $_POST["opening"], 
        'closing' => $_POST["closing"],
        'address' => $_POST["address"],
        'Resphone' => $_POST["Resphone"],
        'consumption' => $_POST["consumption"],                                                                       
    ];

    if($query['opening'] == "00:00") 
        $query['opening'] = "1";
    else if($query['opening'] == "02:00") 
        $query['opening'] = "2";
    else if($query['opening'] == "04:00") 
        $query['opening'] = "3";
    else if($query['opening'] == "06:00") 
        $query['opening'] = "4";
    else if($query['opening'] == "08:00") 
        $query['opening'] = "5";
    else if($query['opening'] == "10:00") 
        $query['opening'] = "6";
    else if($query['opening'] == "12:00") 
        $query['opening'] = "7";
    else if($query['opening'] == "14:00") 
        $query['opening'] = "8";
    else if($query['opening'] == "16:00") 
        $query['opening'] = "9";
    else if($query['opening'] == "18:00") 
        $query['opening'] = "10";
    else if($query['opening'] == "20:00") 
        $query['opening'] = "11";
    else if($query['opening'] == "22:00") 
        $query['opening'] = "12";
    
    if($query['closing'] == "00:00") 
        $query['closing'] = "1";
    else if($query['closing'] == "02:00") 
        $query['closing'] = "2";
    else if($query['closing'] == "04:00") 
        $query['closing'] = "3";
    else if($query['closing'] == "06:00") 
        $query['closing'] = "4";
    else if($query['closing'] == "08:00") 
        $query['closing'] = "5";
    else if($query['closing'] == "10:00") 
        $query['closing'] = "6";
    else if($query['closing'] == "12:00") 
        $query['closing'] = "7";
    else if($query['closing'] == "14:00") 
        $query['closing'] = "8";
    else if($query['closing'] == "16:00") 
        $query['closing'] = "9";
    else if($query['closing'] == "18:00") 
        $query['closing'] = "10";
    else if($query['closing'] == "20:00") 
        $query['closing'] = "11";
    else if($query['closing'] == "22:00") 
        $query['closing'] = "12";
        

    updateData((int)$query['location'], (int)$query['type'], (int)$query['capacity'], $query['opening'], $query['closing'], $intro, $query['address'], $query['Resphone'], (int)$query['consumption'], $payment, (int)$park, (int)$elevator, (int)$wifi, (int)$wheel, (int)$pet, (int)$kid, $conn);
}

function updateData($location, $type, $capacity, $opening, $closing, $intro, $address, $Resphone, $consumption, $payment, $park, $elevator, $wifi, $wheel, $pet, $kid, $conn)
{ 
    $name = $_SESSION['id_r'];
    $sql = "SELECT * FROM intro_res WHERE username_res = '$name'";
    $result = mysqli_query($conn,$sql);
    $db_username=NULL;
    while($row = mysqli_fetch_assoc($result))
    {
        $db_username = $row['username_res'];
    }
    if(is_null($db_username))
    {
        $sql3 = "INSERT INTO intro_res VALUES ('$name', '$type', '$intro', '$address', '$location', '$Resphone', '$capacity', '$opening', '$closing', '$consumption', '$payment', '$park', '$elevator', '$wifi', '$wheel', '$pet', '$kid')";
        mysqli_query($conn,$sql3);
        alert2('為新增帳號','../view/res_home.php');
    }
    else
    {
        $sql2 = "UPDATE intro_res SET type='$type', introduction='$intro', address='$address', area='$location', telephone='$Resphone', capacity='$capacity',opening='$opening',closing='$closing',consumption='$consumption',payment='$payment',Park_N='$park',Elevator_N='$elevator',wifi_N='$wifi',wheelchair_N='$wheel', Pet_N='$pet',kid_N='$kid' WHERE username_res = '$name'";
        mysqli_query($conn,$sql2);
        alert2('修改完成','../view/res_home.php');
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