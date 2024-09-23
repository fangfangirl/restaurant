<?php
require_once 'config.php';
session_start();
//echo"<script>alert('有近來');</script>";
$bookres = $_POST['bookres'];
$bookdate = $_POST['bookdate'];
$bookname = $_SESSION['id_c'];
//echo"<script>alert('$bookres,$bookdate,$bookname');</script>";
$trash = 0;
$today = date('Y-m-d');
/*$sql = "SELECT * 
        FROM booklist 
        WHERE  username_res = '$bookres' AND date = '$bookdate' ";*/
$count = -1;
if(!empty($bookdate) || !empty($bookres))
{
    if(empty($bookdate))
    {
       // echo"<script>alert('???');</script>";
        $sql = "SELECT * 
                FROM booklist AS B, user_restaurant AS R 
                WHERE R.username_res = B.username_res AND B.username_cus = '$bookname' AND R.name like '%$bookres%' AND B.date >= '$today'
                ORDER BY date ASC, booktime ASC "; 
    }
    else if(empty($bookres))
    {
        //echo"<script>alert('!!!');</script>";
        $sql = "SELECT * 
                FROM booklist AS B, user_restaurant AS R 
                WHERE R.username_res = B.username_res AND B.username_cus = '$bookname' AND  B.date = '$bookdate'
                ORDER BY date ASC, booktime ASC ";  
    }
    else{
        //echo"<script>alert('???');</script>";
        $sql = "SELECT * 
                FROM booklist AS B, user_restaurant AS R 
                WHERE R.username_res = B.username_res AND B.username_cus = '$bookname' AND (R.name like '%$bookres%' AND B.date = '$bookdate')
                ORDER BY date ASC, booktime ASC "; 
    }
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    
    while($row1 = mysqli_fetch_assoc($result))
    {
        $data[] = $row1;
    }
$timearray = array();

    for($i=0;$i<$count;$i++)
    {
        $timearray[$i] = $data[$i]['booktime'];
        switch ($data[$i]['booktime']) {
            case 1:
                $data[$i]['booktime'] = "00:00";
            break;
            case 2:
                $data[$i]['booktime'] = "02:00";
            break;
            case 3:
                $data[$i]['booktime'] = "04:00";
            break;
            case 4:
                $data[$i]['booktime'] = "06:00";
            break;
            case 5:
                $data[$i]['booktime'] = "08:00";
            break;
            case 6:
                $data[$i]['booktime'] = "10:00";
            break;
            case 7:
                $data[$i]['booktime'] = "12:00";
            break;
            case 8:
                $data[$i]['booktime'] = "14:00";
            break;
            case 9:
                $data[$i]['booktime'] = "16:00";
            break;
            case 10:
                $data[$i]['booktime'] = "18:00";
            break;
            case 11:
                $data[$i]['booktime'] = "20:00";
            break;
            case 12:
                $data[$i]['booktime'] = "22:00";
            break;
        }
    }
}

?>

<table class="highlight">

    <?php
        sleep(1);
        if($count >0 ){
    ?>
	<thead>
		<tr>
            <th>餐廳名稱</th>
			<th>人數</th>
			<th>日期</th>
			<th>時間</th>
			<th>備註</th>
            <th>修改訂單</th>
		</tr>
	</thead>
    <?php
    }else if($count == 0)
    {
        echo "對不起查無此紀錄";
    }
    else if($count == -1)
    {
        echo "請輸入想要搜尋的時間或餐廳";
    }
    ?>
    <?php
        for($i=0;$i<$count;$i++){
            $res_list = $data[$i]['username_res'];
            $date = $data[$i]['date'];
            $time = $data[$i]['booktime'];
            $number = $data[$i]['number'];
            $remark = $data[$i]['remark'];
            $res_URL = "update_CusReservation.php?id_r=$res_list&number=$number&date=$date&time=$timearray[$i]&remark=$remark";
    ?>
	<tbody id="search-results">
		<tr>
			<td><?php echo $data[$i]['name']?></td>
			<td><?php echo $data[$i]['number']?></td>
            <td><?php echo $data[$i]['date']?></td>
			<td><?php echo $data[$i]['booktime']?></td>
			<td><?php echo $data[$i]['remark']?></td>
            <td><a class="waves-effect red btn" href=<?php echo $res_URL;?> <?php $_SESSION['delete_book']=TRUE?>>修改</a></td>
        </tr>
        <?php
        }
    ?>
	</tbody>
    </table>


<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">

