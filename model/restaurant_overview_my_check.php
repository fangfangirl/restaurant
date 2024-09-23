<?php
require_once 'config.php';
session_start();

//echo"<script>alert('有近來');</script>";
$name = $_POST['name'];
$location = $_POST['location'];
$type = $_POST['type'];

//echo"<script>alert('$location,$type');</script>";
if(!empty($name)) 
{
    $sql = "SELECT * 
            FROM intro_res AS I,user_restaurant AS R 
            WHERE 1 = 1";
    
    $sql .= " AND R.name like '%$name%' AND R.username_res = I.username_res ";
    if(!empty($location)) 
    {
        $sql .= " AND area = '$location'";
    }
    if(!empty($type)) 
    {
        $sql .= " AND type = '$type'";
    }
}
else{
    $sql = "SELECT * 
            FROM intro_res AS I
            WHERE 1 = 1";
    if(!empty($location)) 
    {
        $sql .= " AND I.area = '$location'";
    }
    if(!empty($type)) 
    {
        $sql .= " AND I.type = '$type'";
    }
}


$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
//echo"<script>alert('$count');</script>";

while($row1 = mysqli_fetch_assoc($result))
{
    $data[] = $row1;
}

//echo"<script>alert('$count');</script>";
?>

<?php
        if($count ==0 )
            echo "查無相關結果";
        else{
            for($i=0;$i<$count;$i++){
            $username = $data[$i]['username_res'];
            
            switch ($data[$i]['opening']) {
                case 1:
                    $data[$i]['opening'] = "00:00";
                break;
                case 2:
                    $data[$i]['opening'] = "02:00";
                break;
                case 3:
                    $data[$i]['opening'] = "04:00";
                break;
                case 4:
                    $data[$i]['opening'] = "06:00";
                break;
                case 5:
                    $data[$i]['opening'] = "08:00";
                break;
                case 6:
                    $data[$i]['opening'] = "10:00";
                break;
                case 7:
                    $data[$i]['opening'] = "12:00";
                break;
                case 8:
                    $data[$i]['opening'] = "14:00";
                break;
                case 9:
                    $data[$i]['opening'] = "16:00";
                break;
                case 10:
                    $data[$i]['opening'] = "18:00";
                break;
                case 11:
                    $data[$i]['opening'] = "20:00";
                break;
                case 12:
                    $data[$i]['opening'] = "22:00";
                break;
            }

            switch ($data[$i]['closing']) {
                case 1:
                    $data[$i]['closing'] = "00:00";
                break;
                case 2:
                    $data[$i]['closing'] = "02:00";
                break;
                case 3:
                    $data[$i]['closing'] = "04:00";
                break;
                case 4:
                    $data[$i]['closing'] = "06:00";
                break;
                case 5:
                    $data[$i]['closing'] = "08:00";
                break;
                case 6:
                    $data[$i]['closing'] = "10:00";
                break;
                case 7:
                    $data[$i]['closing'] = "12:00";
                break;
                case 8:
                    $data[$i]['closing'] = "14:00";
                break;
                case 9:
                    $data[$i]['closing'] = "16:00";
                break;
                case 10:
                    $data[$i]['closing'] = "18:00";
                break;
                case 11:
                    $data[$i]['closing'] = "20:00";
                break;
                case 12:
                    $data[$i]['closing'] = "22:00";
                break;
            }
            $sql = "SELECT name
                    FROM user_restaurant AS R 
                    WHERE username_res = '$username' ";
            $result = mysqli_query($conn,$sql);
            $row2 = mysqli_fetch_assoc($result);

            $sql = "SELECT bin_data, filetype
                    FROM imgpic 
                    WHERE username_res = '$username' AND description = '餐廳' ";
            $result = mysqli_query($conn,$sql);
            $row3 = mysqli_fetch_assoc($result);
            if($row3)
            {
                $imageURL = 'data:image/' . $row3['filetype'] . ';base64,' . base64_encode($row3['bin_data']);
            }
        ?>
            <div class="card" >
				<div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src= <?php echo $imageURL;?> style="width: 100%; height: auto;">
                </div>
                <div class="card-content">
					<!--後端資料放置處-->
					<span class="card-title activator grey-text text-darken-4"><?php echo $row2['name'];?><a class="btn btn-floating info right tooltipped" data-position="top" data-delay="50" data-tooltip="查看餐廳資訊"><i class="material-icons">info</i></a></span>
					<br><div class="divider"></div><br>
					<a class="btn waves-effect waves-light modal-trigger right" href="#modal" onclick="setUsername('<?php echo $data[$i]['username_res']; ?>','<?php echo $data[$i]['opening'];?>','<?php echo $data[$i]['closing'];?>')">直接訂位</a>
					<br>
                </div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i><?php echo $row2['name'];?><!--引入餐廳名字--></span>
					<p><!--引入餐廳基本資訊-->
                    <?php echo $data[$i]['introduction'];?>
					</p>
					<div class="divider"></div><br>
					<span><i class="tiny material-icons">fmd_good</i> 地址 : <?php echo $data[$i]['address'];?><!--echo餐廳地址--></span><br>
					<span><i class="tiny material-icons">phone</i> 聯絡電話 : <?php echo $data[$i]['telephone'];?></span><br>
					<span><i class="tiny material-icons">store</i> 營業時間 : <?php echo $data[$i]['opening'];?> ~ <?php echo $data[$i]['closing'];?></span>
                    <div style="display:none" ><?php echo $data[$i]['username_res']?></div>
					<br><br>
					<a class="btn waves-effect waves-light" href="restaurant_view.php?username_res=<?php echo $data[$i]['username_res'];?>">看更多詳細資訊</a>
				</div>
            </div>
        
<?php
    }}

?>



<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">

