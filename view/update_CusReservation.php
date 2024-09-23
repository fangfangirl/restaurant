<?php 
session_start();
require_once '../model/config.php';

if( !isset($_SESSION["login_c"]) || $_SESSION["login_c"]===false)
    {
        header("Location: index.php");
        exit;
    }
if( !isset($_SESSION["delete_book"]) || $_SESSION["delete_book"]===false)
{
    header("Location: reservation_info.php");
    exit;
}

$username_cus = $_SESSION['id_c'];
$username_res = $_GET['id_r'];
$username_date = $_GET['date'];
$username_time = $_GET['time'];
$username_number = $_GET['number'];
$username_remark = $_GET['remark'];

$delete_URL = "../model/delete_CusReservation.php?id_r=$username_res&number=$username_number&date=$username_date&time=$username_time&remark=$username_remark";
$change_URL = "../model/update_CusReservation_check.php";

$sql = "SELECT * FROM user_customer WHERE username_cus = '$username_cus'";
$result = mysqli_query($conn,$sql);

 if (!empty($result)) 
 {
	while($row = mysqli_fetch_assoc($result))
    {
        $name = $row['name'];
 		$username = $row['username_cus'];
		$email = $row['email'];
		$phone = $row['telephone']; 
    }
 }

 

 $sql6 = "SELECT * FROM intro_res WHERE username_res = '$username_res'";
 $result6 = mysqli_query($conn,$sql6);
 
  if (!empty($result6)) 
  {
	 while($row6 = mysqli_fetch_assoc($result6))
	 {
		 $opening = $row6['opening'];
		 $closing = $row6['closing'];
	 }
  }

  $sql11 = "SELECT name FROM user_restaurant  WHERE username_res = '$username_res'";
  $result11 = mysqli_query($conn,$sql11);
  $k = 0;
  while($row11 = mysqli_fetch_assoc($result11)){
	  $restaurant_name = $row11['name'];
  }


$opening1 = $opening;
$closing1 = $closing;
 
 switch ($opening) {
	case 1:
		$opening = "00:00";
	break;
	case 2:
		$opening = "02:00";
	break;
	case 3:
		$opening = "04:00";
	break;
	case 4:
		$opening = "06:00";
	break;
	case 5:
		$opening = "08:00";
	break;
	case 6:
		$opening = "10:00";
	break;
	case 7:
		$opening = "12:00";
	break;
	case 8:
		$opening = "14:00";
	break;
	case 9:
		$opening = "16:00";
	break;
	case 10:
		$opening = "18:00";
	break;
	case 11:
		$opening = "20:00";
	break;
	case 12:
		$opening = "22:00";
	break;
}

switch ($closing) {
	case 1:
		$closing = "00:00";
	break;
	case 2:
		$closing = "02:00";
	break;
	case 3:
		$closing = "04:00";
	break;
	case 4:
		$closing = "06:00";
	break;
	case 5:
		$closing = "08:00";
	break;
	case 6:
		$closing = "10:00";
	break;
	case 7:
		$closing = "12:00";
	break;
	case 8:
		$closing = "14:00";
	break;
	case 9:
		$closing = "16:00";
	break;
	case 10:
		$closing = "18:00";
	break;
	case 11:
		$closing = "20:00";
	break;
	case 12:
		$closing = "22:00";
	break;
}

$sql17 = "SELECT bin_data, filetype
FROM imgpic_c
WHERE username_cus = '$username_cus'";
$result17 = mysqli_query($conn,$sql17);
$row17 = mysqli_fetch_assoc($result17);
if($row17)
{
	$imageURL17 = 'data:image/' . $row17['filetype'] . ';base64,' . base64_encode($row17['bin_data']);
}

?>


<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
		
		<!--Import css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="css/index.css">
		<link type="text/css" rel="stylesheet" href="css/res_view.css">
		
		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
		<meta charset="utf-8">
		<title>聚食 - Update Reservation</title>
		
	</head>
  
  
	<body>
			
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper  deep-orange lighten-3">
					<a  href="index2.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<ul id="nav-mobile" class="left hide-on-med-and-down">
						<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
					</ul>
					<a class="brand-logo center"><i class="material-icons">filter_tilt_shift</i>訂位資訊更改</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="restaurant_overview.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="找更多餐廳"><i class="material-icons">search</i></a></li>
						<li><a href="reservation_info.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="查看已訂位資訊"><i class="material-icons">assignment</i></a></li>
						<li><a href="help.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回報問題"><i class="material-icons">help_outline</i></a></li>
					</ul>
				</div>
			</nav>
		</div>
		
		<!--floating button-->
		<div class="fixed-action-btn">
			<a class="btn-floating btn-large deep-orange lighten-3 pulse" id="fav">
				<i class="large material-icons">connect_without_contact</i>
			</a>
		</div>

		<!-- Tap Target Structure -->
		<div class="tap-target" data-activates="fav">
			<div class="tap-target-content">
				<h5>提示信息</h5>
				<p>您可以在這一頁修改訂位資訊</p>
			</div>
		</div>

		<!--sidenav區域-->
		<ul id="slide-out" class="side-nav">
			<li class="sidenav-header deep-orange lighten-3">
				<a class="center white-text">User_Profile</a>
			</li>
			<li>
				<div class="user-view">
					<div class="background">
						<img src="pics/unsplash1.jpg">
					</div>
					<a><img class="circle" src=<?php echo $imageURL17;?>></a>
					<a><span class="white-text name"><?php echo $name;?></span></a>
					<a><span class="white-text email"><?php echo $email;?></span></a>
				</div>
			</li>
			
			<li>
                <ul class="collapsible collapsible-accordion">
                  <li class="no-padding">
                    <a class="collapsible-header">檢視個人資料<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a>&emsp;&emsp;&emsp;姓名: &emsp;<?php echo $name;?></a></li>
                        <li><a>&emsp;&emsp;&emsp;電話: &emsp;<?php echo $phone;?></a></li>
                        <li><a>&emsp;&emsp;&emsp;電子郵件: &emsp;<?php echo $email;?></a></li>
						<li><a>&emsp;&emsp;&emsp;帳號: &emsp;<?php echo $username;?></a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
            </li>
			
			<li><div class="divider"></div></li>
			<li><a href="update_CusAccount.php"><i class="material-icons">edit</i>修改個人資料</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="logout_c.php"><i class="material-icons">logout</i>登出</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="../model/delete_c.php" onclick=confirmDelete(event) ><i class="material-icons">delete</i>刪除帳號</a></li>	
		</ul> 
		
		<section>
			<div class="container">
				<div class="row">
					<div class="col s12 brown lighten-4" style="padding: 30px;">
						<br><br>
						<div class="col s12 brown lighten-5" style="padding: 50px;">
							<a href=<?php echo $delete_URL;?> class="btn wave-effect red right" onclick=confirmDelete1(event)>取消此訂位<i class="material-icons right">delete</i></a>
							<div class="row">
								<div class="col s8 offset-s2">
									<div>
										<form method="post"  action=<?php echo $change_URL;?>>
											<div class="col s12">
												<h1> </h1>
											</div>
											<div class="input-field col s12">
												<div class="col s4"><label>&emsp;訂位餐廳 :</label></div>
												<div class="col s8">
													<!--這邊value填入訂位的餐廳名稱-->													
													<input disabled value=<?php echo $restaurant_name;?> id="disabled" type="text" class="validate">
												</div>
											</div>
											<div class="input-field col s12">
												<div class="col s4"><label>&emsp;人數 :</label></div>
												<div class="col s8">
													<select name="booknum" required>
														<option value="" disabled selected>0 位</option>
														<option value="1" <?php if($username_number == 1) echo 'selected';?>>1位</option>
														<option value="2" <?php if($username_number == 2) echo 'selected';?>>2位</option>
														<option value="3" <?php if($username_number == 3) echo 'selected';?>>3位</option>
														<option value="4" <?php if($username_number == 4) echo 'selected';?>>4位</option>
														<option value="5" <?php if($username_number == 5) echo 'selected';?>>5位</option>
														<option value="6" <?php if($username_number == 6) echo 'selected';?>>6位</option>
														<option value="7" <?php if($username_number == 7) echo 'selected';?>>7位</option>
														<option value="8" <?php if($username_number == 8) echo 'selected';?>>8位</option>
														<option value="9" <?php if($username_number == 9) echo 'selected';?>>9位</option>
														<option value="10" <?php if($username_number == 10) echo 'selected';?>>10位</option>
														<option value="11" <?php if($username_number == 11) echo 'selected';?>>11位</option>
														<option value="12" <?php if($username_number == 12) echo 'selected';?>>12位</option>
														<option value="13" <?php if($username_number == 13) echo 'selected';?>>13位</option>
														<option value="14" <?php if($username_number == 14) echo 'selected';?>>14位</option>
														<option value="15" <?php if($username_number == 15) echo 'selected';?>>15位</option>
														<option value="16" <?php if($username_number == 16) echo 'selected';?>>16位</option>
														<option value="17" <?php if($username_number == 17) echo 'selected';?>>17位</option>
														<option value="18" <?php if($username_number == 18) echo 'selected';?>>18位</option>
														<option value="19" <?php if($username_number == 19) echo 'selected';?>>19位</option>
														<option value="20" <?php if($username_number == 20) echo 'selected';?>>20位</option>
													</select>
												</div>
											</div>
											<div class="input-field col s12">
												<div class="col s4">
													<label for="bookdate">&emsp;日期 :</label>
												</div>
												<div class="col s8">
													<input type="date" id="bookdate" name="bookdate" value =<?php echo $username_date;?> required>
												</div>
												<div class="col s8">
													<input type="hidden" id="restaurant_book" name="number_old" value=<?php echo $username_number;?>>
													<input type="hidden" id="restaurant_book" name="date_old" value=<?php echo $username_date;?>>
													<input type="hidden" id="restaurant_book" name="time_old" value=<?php echo $username_time;?>>
													<input type="hidden" id="restaurant_book" name="remark_old" value=<?php echo $username_remark;?>>
													<input type="hidden" id="restaurant_book" name="restaurant_book" value=<?php echo $username_res;?>>
												</div>
											</div>
											<div class="input-field col s12">
												<div class="col s4">
													<label for="start">&emsp;時間 :</label>
												</div>
												<div id="time_ava" name= "time_ava" class="col s8">
													<select id="booktime" name="booktime" required>
														<option value="" disabled selected></option>
														<option value="1" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 1 || $closing1 <= 1) echo 'disabled';}?> <?php if($username_time == 1) echo 'selected';?>>00:00</option>
														<option value="2" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 2 || $closing1 <= 2) echo 'disabled';}?> <?php if($username_time == 2) echo 'selected';?>>02:00</option>
														<option value="3" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 3 || $closing1 <= 3) echo 'disabled';}?> <?php if($username_time == 3) echo 'selected';?>>04:00</option>
														<option value="4" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 4 || $closing1 <= 4) echo 'disabled';}?> <?php if($username_time == 4) echo 'selected';?>>06:00</option>
														<option value="5" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 5 || $closing1 <= 5) echo 'disabled';}?> <?php if($username_time == 5) echo 'selected';?>>08:00</option>
														<option value="6" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 6 || $closing1 <= 6) echo 'disabled';}?> <?php if($username_time == 6) echo 'selected';?>>10:00</option>
														<option value="7" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 7 || $closing1 <= 7) echo 'disabled';}?> <?php if($username_time == 7) echo 'selected';?>>12:00</option>
														<option value="8" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 8 || $closing1 <= 8) echo 'disabled';}?> <?php if($username_time == 8) echo 'selected';?>>14:00</option>
														<option value="9" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 9 || $closing1 <= 9) echo 'disabled';}?> <?php if($username_time == 9) echo 'selected';?>>16:00</option>
														<option value="10" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 10 || $closing1 <= 10) echo 'disabled';}?> <?php if($username_time == 10) echo 'selected';?>>18:00</option>
														<option value="11" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 11 || $closing1 <= 11) echo 'disabled';}?> <?php if($username_time == 11) echo 'selected';?>>20:00</option>
														<option value="12" <?php if(isset($opening1) && isset($closing1)){if($opening1 > 12 || $closing1 <= 12) echo 'disabled';}?> <?php if($username_time == 12) echo 'selected';?>>22:00</option>
													</select>	
												</div>
											</div>
											<div class="input-field col s12">
												<div class="col s4">
													<label for="note">&emsp;備註 :<br>&emsp;(選填)</label>
												</div>
												<div class="col s8">
													<textarea id="note" class="materialize-textarea" data-length="30" name="booknote"><?php echo $username_remark;?></textarea>
												</div>
											</div>
											<div class="col s12">
												<button class="btn waves-effect waves-light right" type="submit" name="action1">確認修改
													<i class="material-icons right">send</i>
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
								
							<div class="col s12">
								<h1> </h1>
							</div>
						</div>
						<div class="col s12">
							<h1> </h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		
		<!-- Footer -->
		<footer class="page-footer grey lighten-1">
			<div class="container">
				<div class="row">
					<div class="col l7 offset-l1 s12">
						<h4 class="white-text">Contact Us</h4>
						<p class="grey-text text-darken-4">
							TEL : 0000 - 000 - 000<br>
							E-MAIL : 聚食team@nycu.edu.tw<br>
							ADDRESS : 新竹市東區大學路1001號<br>
						</p>
					</div>
					<div class="col l4 s12">
						<br><br><br><br>
						&emsp;
						<a href="#"><i class="small material-icons white-text">facebook</i></a>
						&emsp;
						<a  href="#"><i class="small material-icons white-text">email</i></a>
						&emsp;
						<a href="#"><i class="small material-icons white-text">slideshow</i></a>
					</div>
	
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container center">
				Made by <a class="brown-text text-darken-4" href="#!">&emsp;聚食 team </a>
				</div>
			</div>
		</footer>

		<!--  Scripts-->
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script type="text/javascript" src="js/res_view.js"></script>		
		<script src="js/init.js"></script>
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script>
			function confirmDelete1(event) {
				event.preventDefault(); // 阻止链接默认的跳转行为
				var book_date = '<?php echo $username_date; ?>'; // 将 PHP 变量传递给 JavaScript
				//alert(book_date);
				var data_now = new Date();
				var year = data_now.getFullYear();
				var month = data_now.getMonth()+1 <10 ? "0" + (data_now.getMonth()+1) : (data_now.getMonth()+1);
				var day = data_now.getDate() <10 ? "0" + data_now.getDate() : data_now.getDate();
				var data_now = year + '-' + month + '-' + day;
				//alert(data_now);
				//var formattedTime = addLeadingZero(hours) + ':' + addLeadingZero(minutes) + ':' + addLeadingZero(seconds);
				//alert(data_now);
				if (book_date == data_now) {
					swal({
						icon: 'error',
						title: '提醒!!',
						text: '今天的訂位資訊無法刪除',
						buttons: {
							cancel: {
								text: "取消",
								visible: true,
							}
						}
					});
					return false;
				} else {
					swal({
						icon: 'warning',
						title: '確認刪除此訂位？',
						text: '此操作將永遠刪除您的訂位！',
						buttons: {
							cancel: {
								text: "取消",
								visible: true,
								value: 0
							},
							confirm: {
								text: "刪除",
								visible: true,
								value: 1
							}
						}
					}).then((value) => {
						if (value == 1)
							window.location.href = event.target.href;
						else
							return false;
					});
				}
			}
		</script>

		
	</body>

</html>




