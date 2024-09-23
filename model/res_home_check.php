<?php
require_once 'config.php';
session_start();
//echo"<script>alert('有近來');</script>";

$date = $_POST['date'];
$username_res = $_SESSION['id_r'];
//echo"<script>alert('$date');</script>";

/*$sql = "SELECT * 
        FROM booklist 
        WHERE  username_res = '$bookres' AND date = '$bookdate' ";*/

$sql = "SELECT *  
        FROM booklist AS B,user_customer AS C
        WHERE B.username_cus = C.username_cus AND B.date = '$date' AND B.username_res='$username_res'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
//echo"<script>alert('$count');</script>";


while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

$num = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$date_book = array();
$flag = -1;
//echo"<script>alert('$count 嗎?');</script>";
for($i=0;$i<$count;$i++)
{
	$flag = 0;
	/*$tt = $data[$i]['booktime'];
	echo"<script>alert('$tt ??');</script>";*/
    switch ($data[$i]['booktime']) {
        case 1:
			$num[1] = $num[1] + 1;
            $date_book[1] = "00:00";
        break;
        case 2:
			$num[2] = $num[2] + 1;
            $date_book[2] = "02:00";
        break;
        case 3:
			$num[3] = $num[3] + 1;
            $date_book[3] = "04:00";
        break;
        case 4:
			$num[4] = $num[4] + 1;
            $date_book[4] = "06:00";
        break;
        case 5:
			$num[5] = $num[5] + 1;
            $date_book[5] = "08:00";
        break;
        case 6:
			$num[6] = $num[6] + 1;
            $date_book[6] = "10:00";
        break;
        case 7:
			$num[7] = $num[7] + 1;
            $date_book[7] = "12:00";
        break;
        case 8:
			$num[8] = $num[8] + 1;
            $date_book[8] = "14:00";
        break;
        case 9:
			$num[9] = $num[9] + 1;
            $date_book[9] = "16:00";
        break;
        case 10:
			$num[10] = $num[10] + 1;
            $date_book[10] = "18:00";
        break;
        case 11:
			$num[11] = $num[11] + 1;
            $date_book[11] = "20:00";
        break;
        case 12:
			$num[12] = $num[12] + 1;
            $date_book[12] = "22:00";
        break;
    }
}
?>
				<?php if($num[1] != 0){?>
                <div class="section">
					
					<h5>00:00-02:00</h5>
					<table class="highlight centered bordered responsive-table">
						<!--橫軸標題-->
						<thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
						</thead>
						<!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 1)
                            {
                        ?>
						<tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[1];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="btn waves-effect cyan modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
						</tbody>
                        <?php 
                            }}}
                        ?>
					</table>
				</div>
				
				<?php if($num[2] != 0){?>
				<div class="section">
					<h5>02:00-04:00</h5>
					<table class="highlight centered bordered responsive-table">
						<!--橫軸標題-->
						<thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
						</thead>
						<!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 2)
                            {
                        ?>
						<tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[2];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
						</tbody>
                        <?php 
                            }}}
                        ?>
					</table>
				</div>
				<?php if($num[3] != 0){?>
				<div class="section">
					<h5>04:00-06:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 3)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[3];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
            
				<?php if($num[4] != 0){?>
				<div class="section">
					<h5>06:00-08:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 4)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[4];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
				<?php if($num[5] != 0){?>
				<div class="section">
					<h5>08:00-10:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 5)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[5];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
				<?php if($num[6] != 0){?>
				<div class="section">
					<h5>10:00-12:00</h5>
					<table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 6)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[6];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
				<?php if($num[7] != 0){?>
				<div class="section">
					<h5>12:00-14:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 7)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[7];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
       
				<?php if($num[8] != 0){?>
				<div class="section">
					<h5>14:00-16:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 8)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[8];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
        
				<?php if($num[9] != 0){?>
				<div class="section">
					<h5>16:00-18:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
                        <tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 9)
                            {
                        ?>
                        <tbody>
							<tr>
                            <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[9];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
      
				<?php if($num[10] != 0){?>
				<div class="section">
					<h5>18:00-20:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 10)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[10];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
        
				<?php if($num[11] != 0){?>
				<div class="section">
					<h5>20:00-22:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 11)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[11];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')">備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}}
                        ?>
                    </table>
				</div>
       
				<?php if($num[12] != 0){?>
				<div class="section">
					<h5>22:00-24:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <?php 
                        for($i=0;$i<$count;$i++){
                            if($data[$i]['booktime'] == 12)
                            {
                        ?>
                        <tbody>
							<tr>
                                <td><?php echo $data[$i]['name'];?></td>
								<td><?php echo $date_book[12];?></td>
								<td><?php echo $data[$i]['telephone'];?></td>
								<td><?php echo $data[$i]['number'];?></td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal" onclick="setremark('<?php echo $data[$i]['remark'];?>')" >備註</a>
								</td>
							</tr>
                        </tbody>
                        <?php 
                            }}
                        ?>
                    </table>
				</div>
				<?php }else if($flag == -1){?>
				<div class="section">
					<h5></h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>最後結果</th>
								
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
                                <td><?php echo "查無任何資料";?></td>
							</tr>
                        </tbody>
                        <?php 
                            }
                        ?>
                    </table>
				</div>

<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">