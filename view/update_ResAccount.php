<?php 

session_start();
require_once '../model/config.php';

if( !isset($_SESSION["login_r"]) || $_SESSION["login_r"]===false)
    {
        header("Location: index.php");
        exit;
    }

	if($_SESSION["login_check"]===true)
	{
		header("Location: update_ResInfo.php");
		exit;
	}

$username_res = $_SESSION['id_r'];

$sql = "SELECT * FROM user_restaurant WHERE username_res = '$username_res'";
$result = mysqli_query($conn,$sql);

 if (!empty($result)) 
 {
	while($row = mysqli_fetch_assoc($result))
    {
        $nameres = $row['name'];
		$name = $row['bossname'];
		$email = $row['email'];
		$tel = $row['telephone']; 
    }
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
		
		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
		<meta charset="utf-8">
		<title>聚食 - Update Account</title>
		
	</head>
  
	<body>

		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper  deep-orange lighten-3">
					<a  href="res_home.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">filter_tilt_shift</i>餐廳資料修改</a>
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
								<a class="btn deep-orange lighten-3 " href="update_ResInfo.php">更新餐廳資訊</a>
								<font size="1"> / </font>
								<a class="btn deep-orange lighten-3 " href="update_ResPassword.php">修改密碼</a>
							</div>
							<div class="row">
								<div class="col s8 offset-s2">
									<br>
									<h5>餐廳資料修改</h5>
									<div>
										<form name='changeaccount_r' method="post" onsubmit="return enter()" action="../model/update_ResAccount_check.php">
											<div class="col s12">
												<h1> </h1>
											</div>
											<div class="input-field col s12">
												<input type="text" placeholder="Restaurant Name..." class="validate" name="nameres" value="<?php echo $nameres;?>" required >
												<label>餐廳名稱</label>
											</div>
											<div class="input-field col s12">
												<input type="text" placeholder="Owner Name..." class="validate" name="name" value="<?php echo $name;?>" required >
												<label>餐廳負責人姓名</label>
											</div>
											<div class="input-field col s12">
												<input type="tel" placeholder="Owner Number..." class="validate" name="tel" pattern="09[0-9]{2}-[0-9]{3}-[0-9]{3}" value="<?php echo $tel;?>"  required >
												<label>負責人連絡電話</label>
											</div>
											<div class="input-field col s12">
												<input type="text" placeholder="Your Email..." class="validate" name="email" value="<?php echo $email;?>"  required >
												<label>電子郵件</label>
											</div>					
											<div class="col s12">
												<h5>&emsp;</h5>
											</div>
											<div class="col s12">
												<div class="input-field col s8">
													<input type="password" placeholder="Confirm Password..." class="validate" name="password">
													<label>輸入密碼以儲存變更</label>
												</div>
												<button class="btn waves-effect waves-light" type="submit" name="submit">確認修改
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
		<script src="js/init.js"></script>
		<!--script-->
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script type="text/javascript"> 
			function enter() 
			{ 
				var y1=document.forms["changeaccount_r"]["password"].value; 
				var y2=document.forms["changeaccount_r"]["name"].value; 
				var y3=document.forms["changeaccount_r"]["tel"].value;
				var y4=document.forms["changeaccount_r"]["email"].value;
				var y5=document.forms["changeaccount_r"]["nameres"].value;
				if(y1.length==0)
				{ 
					swal({
						icon: 'warning',
						text: '輸入密碼不可以為空',
						button: 'OK!'
					})
					return false; 
				} 
				else if(y2.length==0 && y3.length==0 && y4.length==0 && y5.length==0)
				{ 
					swal({
						icon: 'warning',
						text: '請至少輸入一個想要修改的內容',
						button: 'OK!'
					})
					return false; 
				} 
			} 
		</script> 
	</body>

</html>


