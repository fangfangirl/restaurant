<?php
session_start();
require_once '../model/config.php';

if( !isset($_SESSION["login_r"]) || $_SESSION["login_r"]===false)
    {
        header("Location: index.php");
        exit;
    }

$username_res = $_SESSION['id_r'];

$sql = "SELECT * FROM intro_res WHERE username_res = '$username_res'";
$result = mysqli_query($conn,$sql);
 if (isset($result) && !empty($result)) 
 {
	//echo"<script>alert('WHY??');</script>";
	while($row = mysqli_fetch_assoc($result))
    {
        $type = $row['type'];
		$introduction = $row['introduction'];
		//echo"<script>alert('$introduction');</script>";
		$addr = $row['address'];
		$location = $row['area'];
		$tel = $row['telephone'];
		$capacity = $row['capacity'];
		$opening = $row['opening'];
		$closing = $row['closing'];
		$consumption = $row['consumption'];
		$payment = $row['payment'];
		$park = $row['Park_N'];
		$wifi = $row['wifi_N'];
		$elevator = $row['Elevator_N'];
		$wheel = $row['wheelchair_N'];
		$pet = $row['Pet_N'];
		$kid = $row['kid_N'];
		$payment1 = explode(" ",$payment);
		$a =0;$b=0;$c=0;
		$co = count($payment1);
		for($i=0;$i<count($payment1);$i++)
		{
			if($payment1[$i] == 1) $a=1;
			else if($payment1[$i] == 2) $b=1;
			else if($payment1[$i] == 3) $c=1;
			//echo"<script>alert('$payment1[$i]');</script>";
		}
		//echo"<script>alert('$co,$a,$b,$c');</script>";
    }
	if(isset($opening)){
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
}
	
 }
?>

<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
		
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="css/index.css">
		
		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset="utf-8">
		<title>聚食 - Update Information</title>
		
	</head>
  
	<body>
		
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a  href="res_home.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">filter_tilt_shift</i>餐廳資訊更新</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="res_home.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回主頁面"><i class="material-icons">house</i></a></li>
						<li><a href="help.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回報問題"><i class="material-icons">help_outline</i></a></li>
					</ul>
				</div>
			</nav>
		</div>
			
		<section>
			<div class="container">
				<div class="row">
					<div class="col s12 brown lighten-4">
						<br><br>
						<div class="col s12 brown lighten-5">
							<br><br>
							<div class="col offset-s7">
								<a class="btn deep-orange lighten-3" href="update_ResAccount.php">修改帳戶資訊</a>
								<font size="1"> / </font>
								<a class="btn deep-orange lighten-3 " href="update_ResPassword.php">修改密碼</a>
							</div>
							
							<div id="res" class="col s8 offset-s2">
								<br>
								<h5>請填入以下餐廳資訊</h5>
								<div>
									<form id=form name="update_resinfo"  method="post"  action="../model/intro_check.php" onsubmit="return enter()" enctype="multipart/form-data">
										<div class="row">
											<div class="col s12">
												<!--餐廳圖片-->
												<div class="file-field input-field col s6">
													<div class="btn-floating waves-effect waves-light" style="background-color: #FFAC81">
													   <i class="material-icons">add</i>
													   <input type="file" name="form_data" size="40" accept="image/*" >
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text"  name="form_description" placeholder="選擇一張餐廳圖片" >
													</div>
												</div>
												<!--菜單圖片-->
												<div class="file-field input-field col s6">
													<div class="btn-floating waves-effect waves-light" style="background-color: #FFAC81">
													   <i class="material-icons">add</i>
													   <input type="file" name="form_data_m[]" size="40" accept="image/*" multiple="multiple">
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text" name="form_description_m"  placeholder="選擇多張菜單照片" >
													</div>
												</div>
											</div>
										</div>
										<div class="col s12">
											<h3> </h3>
										</div>
										<div class="row">
											<div class="col s12">
												<!--地區-->
												<div class="input-field col s4">
													<select name="location"  required >
														<option value="0" disabled selected>地區</option>
														<option value="1" <?php if(isset($location)){ if(strpos($location,'1')!==false) echo 'selected';}?>>北</option>
														<option value="2" <?php if(isset($location)){ if(strpos($location,'2')!==false) echo 'selected';}?>>中</option>
														<option value="3" <?php if(isset($location)){ if(strpos($location,'3')!==false) echo 'selected';}?>>南</option>
													</select>
													<label>所在地區</label>
												</div>
												<!--類型-->
												<div class="input-field col s4">
													<select name="type"  required >
														<option value="" disabled selected>類別</option>
														<option value="1" <?php if(isset($type)){ if(strpos($type,'1')!==false) echo 'selected';}?>>中式</option>
														<option value="2" <?php if(isset($type)){ if(strpos($type,'2')!==false) echo 'selected';}?>>西式</option>
														<option value="3" <?php if(isset($type)){ if(strpos($type,'3')!==false) echo 'selected';}?>>日式</option>
														<option value="4" <?php if(isset($type)){ if(strpos($type,'4')!==false) echo 'selected';}?>>泰式</option>
														<option value="5" <?php if(isset($type)){ if(strpos($type,'5')!==false) echo 'selected';}?>>美式</option>
														<option value="6" <?php if(isset($type)){ if(strpos($type,'6')!==false) echo 'selected';}?>>韓式</option>
													</select>
													<label>餐廳類別</label>
												</div>
												<!--客容量-->
												<div class="input-field col s4">
													<label>請輸入最大顧客容量</label>
													<input type="number" name="capacity" value="<?php if(isset($capacity))echo $capacity;else echo 150;?>" step="10" min="0" max="1000"  required />
												</div>
											</div>
										</div>
										<div class="row">
											<!--營業時間-->
											<div class="input-field col s6">
												<div class="col s6">
													<label for="start">&emsp;請輸入開業時間 :</label>
												</div>
												<div class="col s6">
													<input type="time" id="start" name="opening" step ="7200" value="<?php if(isset($opening))echo $opening;else echo '08:00';?>"  required >
												</div>
											</div>
											<!--歇業時間-->
											<div class="input-field col s6">
												<div class="col s6">
													<label for="endd">&emsp;請輸入歇業時間 :</label>
												</div>
												<div class="col s6">
													<input type="time" id="endd" name="closing" step ="7200" value="<?php if(isset($closing))echo $closing;else echo '16:00';?>"  required >
												</div>
											</div>
										</div>
										<!--簡介-->
										<div class="input-field col s12">
											<textarea id="intro" name="intro" placeholder="Your Restaurant Introduction..." data-length="500" class="materialize-textarea"><?php if(isset($introduction))echo $introduction;?></textarea>
											<label for="address">餐廳簡介</label>
											<span>&emsp;</span>
										</div>
										<!--地址-->
										<div class="input-field col s12">
											<input type="text" id="address" name="address" placeholder="Your Restaurant Address..." class="validate" value="<?php if(isset($addr))echo $addr;?>"  required >
											<label for="address">地址</label>
										</div>
										<!--電話-->
										<div class="input-field col s12">
											<input type="tel" id="Resphone" name="Resphone" placeholder="Your Restaurant Phone Number..." class="validate" pattern="0[0-9]{1}-[0-9]{3,4}-[0-9]{4}" value="<?php if(isset($tel))echo $tel;?>"  required >
											<label for="Resphone">電話</label>
										</div>
										<!--支付方式-->
										<div class="input-field col s12">
											<select multiple id="payment" name="payment[]"  required >
												<option value="0" disabled selected >支付方式</option>
												<option value="1" <?php if(isset($a)){ if(strpos($a,'1')!==false) echo 'selected';}?> >現金</option>
												<option value="2" <?php if(isset($b)){ if(strpos($b,'1')!==false) echo 'selected';}?>>信用卡</option>
												<option value="3" <?php if(isset($c)){ if(strpos($c,'1')!==false) echo 'selected';}?>>行動支付</option>
											</select>
											<label>支援的付款方式</label>
										</div>
										<!--低消-->
										<div class="input-field col s12">
											<select name="consumption"  required >
												<option value="" disabled selected>低消門檻</option>
												<option value="1" <?php if(isset($consumption)){ if(strpos($consumption,'1')!==false) echo 'selected';}?>>無低消</option>
												<option value="2" <?php if(isset($consumption)){ if(strpos($consumption,'2')!==false) echo 'selected';}?>>低消200元以下</option>
												<option value="3" <?php if(isset($consumption)){ if(strpos($consumption,'3')!==false) echo 'selected';}?>>低消2~500元</option>
												<option value="4" <?php if(isset($consumption)){ if(strpos($consumption,'4')!==false) echo 'selected';}?>>低消5~800元</option>
												<option value="5" <?php if(isset($consumption)){ if(strpos($consumption,'5')!==false) echo 'selected';}?>>低消800元以上</option>
											</select>
											<label>內用最低消費門檻</label>
										</div>
										<div class="col s12">
											<h3> </h3>
										</div>
										<div class="row">
											<p>&emsp;&emsp;餐廳設施</p>
											<!--有無停車位-->
											<div class="switch col s4 offset-s1">
												<label>停車位</label>
												<br>
												<label>
												  無
												  <input type="checkbox" name="park" value="1" <?php if(isset($park)){ if(strpos($park,'1')!==false) echo 'checked';}?> >
												  <span class="lever"></span>
												  有
												</label>
											</div>
											<!--有無電梯-->
											<div class="switch col s4">
												<label>電梯</label>
												<br>
												<label>
												  無
												  <input type="checkbox" name="elevator" value="1" <?php if(isset($elevator)){ if(strpos($elevator,'1')!==false) echo 'checked';}?>>
												  <span class="lever"></span>
												  有
												</label>
											</div>
											<!--有無wifi-->
											<div class="switch">
												<label>Wifi</label>
												<br>
												<label>
												  無
												  <input type="checkbox" name="wifi" value="1" <?php if(isset($wifi)){ if(strpos($wifi,'1')!==false) echo 'checked';}?>>
												  <span class="lever"></span>
												  有
												</label>
											</div>
										</div>
										<div class="col s12">
											<h3> </h3>
										</div>
										<div class="row">
											<p>&emsp;&emsp;聚食友善</p>
											<!--輪椅友善-->
											<div class="switch col s4 offset-s1">
												<input type="checkbox" class="filled-in" id="chairman" name="wheel" value="1" <?php if(isset($wheel)){ if(strpos($wheel,'1')!==false) echo 'checked';}?>/>
												<label for="chairman">輪椅友善</label>
											</div>
											<!--寵物友善-->
											<div class="switch col s4">
												<input type="checkbox" class="filled-in" id="pet" name="pet" value="1" <?php if(isset($pet)){ if(strpos($pet,'1')!==false) echo 'checked';}?>/>
												<label for="pet">寵物友善</label>
											</div>
											<!--幼童友善-->
											<div class="switch">
												<input type="checkbox" class="filled-in" id="child" name="kid" value="1" <?php if(isset($kid)){ if(strpos($kid,'1')!==false) echo 'checked';}?>/>
												<label for="child">幼童友善</label>
											</div>
										</div>
										<div class="col s12">
											<h3> </h3>
										</div>
										<button name="action" class="btn waves-effect waves-light" type="submit" >儲存更新
											<i class="material-icons right">send</i>
										</button>
										<div class="col s12">
											<h1> </h1>
										</div>
									</form>
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
		<script src="js/init.js"></script>
		<script>
			$(document).ready(function(){
				$('select').material_select();
			});
		</script>
		<!--script-->
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
			<script type="text/javascript"> 
				function enter() 
				{ 
					var a=document.forms["update_resinfo"]["location"].value;
					var b=document.forms["update_resinfo"]["type"].value;
					var c=document.forms["update_resinfo"]["capacity"].value; 
					var d=document.forms["update_resinfo"]["address"].value; 
					var e=document.forms["update_resinfo"]["Resphone"].value; 
					var selected = [];
					for (var option of document.getElementById('payment').options)
					{
						if (option.selected) {
							selected.push(option.value);
						}
					}
					var flag = 0;
					if(selected.length > 1) flag = 1;
					var g=document.forms["update_resinfo"]["consumption"].value; 
					if(a.length==0 || b.length==0 || c.length==0 || d.length==0 || e.length==0 || flag==0 || g.length==0)
					{ 
						swal({
							icon: 'warning',
							text: '請全部都要填寫',
							button: 'OK!'
						})
						return false; 
					} 
				} 
			</script>
			
	</body>

</html>