<?php
    session_start();
    if(isset($_SESSION["login_c"]) && $_SESSION["login_c"]===true)
    {
        header("Location: index2.php");
        exit;
    }
	if(isset($_SESSION["login_r"]) && $_SESSION["login_r"]===true)
    {
        header("Location: res_home.php");
        exit;
    }
    //setcookie('username',null,time()+3600);
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
		<title>聚食-Register</title>
		
	</head>
  
  
	<body>
			
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a  href="index.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">filter_tilt_shift</i>註冊頁面</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="login.php">Login</a></li>
						<li><a href="index.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回主頁面"><i class="material-icons">house</i></a></li>
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
				<p>您可以在這個頁面進行註冊</p>
			</div>
		</div>
		
		<!--slider-->
		<div class="carousel carousel-slider">
			<a class="carousel-item"><img src="pics/register1.jpg"></a>
			<a class="carousel-item"><img src="pics/register2.jpg"></a>
			<a class="carousel-item"><img src="pics/register3.jpg"></a>
		</div>
		
		<!--註冊表單-->
		<section>
			<div class="container">				
				<div class="row">
					<div class="col s8 offset-s2">
						<!-- Nav tabs -->
						<ul class="tabs">
							<li class="tab col s3"><a href="#cus">顧客</a></li>
							<li class="tab col s3"><a href="#res">餐廳</a></li>
						</ul>
					</div>
					<div id="cus" class="col s8 offset-s2">
						<br>
						<h5>會員註冊</h5>
						<div>
							<form name='register_c' onsubmit="return enter()" method="post" action="../model/registration_check_c.php" enctype="multipart/form-data">
								<!--顧客頭像-->
								<div class="file-field input-field col s12">
									<div class="btn-floating waves-effect waves-light left" style="background-color: #FFAC81">
										<i class="material-icons">add</i>
										<input type="file" name="form_data" size="40" accept="image/*" >
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="  請選擇一張圖片作為您的頭像" >
									</div>
								</div>
								<div class="input-field col s12">
									<input type="text" id="nameuser" name="nameuser" placeholder="Your Name..." class="validate">
									<label for="account">姓名</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="account" name="account" placeholder="Your Account..." class="validate">
									<label for="account">帳號</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="password" name="password" placeholder="Your Password..." class="validate">
									<label for="password">密碼</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="password2" name="password2" placeholder="Confirm Password..." class="validate">
									<label for="password2">確認密碼</label>
								</div>
								<div class="input-field col s12">
									<input type="email" id="email" name="email" placeholder="Your Email..." class="validate">
									<label for="email">電子郵件</label>
								</div>
								<div class="input-field col s12">
									<input type="tel" id="phonenum" name="phonenum" placeholder="Your Phone Number..." class="validate" pattern="09[0-9]{2}-[0-9]{3}-[0-9]{3}">
									<label for="phonenum">連絡電話</label>
								</div>
								<button class="btn waves-effect waves-light" type="submit" name="submit">註冊
									<i class="material-icons right">send</i>
								</button>
							</form>
						</div>
					</div>
					
					<div id="res" class="col s8 offset-s2">
						<br>
						<h5>餐廳註冊</h5>
						<div>
						<form name='register_b' onsubmit="return enter2()" method="post" action="../model/registration_check_b.php">
								<div class="input-field col s12">
									<input type="text" id="nameres" name="nameres" placeholder="Restaurant Name..." class="validate">
									<label for="name">餐廳名稱</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="owner" name="owner" placeholder="Owner Name..." class="validate">
									<label for="name">餐廳負責人姓名</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="accountres" name="accountres" placeholder="Your Account..." class="validate">
									<label for="Cpassword">帳號</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="passwordres" name="passwordres" placeholder="Your Password..." class="validate">
									<label for="Cpassword">密碼</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="password2res" name="password2res" placeholder="Confirm Password..." class="validate">
									<label for="Cpassword">確認密碼</label>
								</div>
								<div class="input-field col s12">
									<input type="email" id="email_res" name="email_res" placeholder="Your Email..." class="validate">
									<label for="Cpassword">電子郵件</label>
								</div>
								<div class="input-field col s12">
									<input type="tel" id="phone_res" name="phone_res" placeholder="Your phone..." class="validate" pattern="09[0-9]{2}-[0-9]{3}-[0-9]{3}">
									<label for="Cpassword">負責人電話</label>
								</div>
								<button class="btn waves-effect waves-light" type="submit" name="action">註冊
									<i class="material-icons right">send</i>
								</button>
								
							</form>
						</div>
					</div>
					<div class="col s12">
						<h5>&emsp;</h5>
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
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script type="text/javascript" src="js/register_page.js"></script>
		<script src="js/init.js"></script>
		
	</body>

</html>




