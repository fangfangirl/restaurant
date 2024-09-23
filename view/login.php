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
		<title>聚食-Login</title>
		
		<!-- Custom fonts for this template -->
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

	</head>
	
	<body>
  	<div style="flex: 1">
	
		
		
		
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper  deep-orange lighten-3">
					<a  href="index.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">filter_tilt_shift</i>登入頁面</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="register.php">Register</a></li>
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
				<p>您可以在這一頁進行登入</p>
			</div>
		</div>
		
		<div class="parallax-container valign-wrapper">
			<div class="parallax"><img src="pics/login.jpg"></div>
		</div>
		
		
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
						<h5>顧客登入</h5>
						<div>
							<form method="post" action="../model/login_check_c.php">
								<div class="input-field col s12">
									<input type="text" id="nameuser" name="nameuser" placeholder="Your Account..." class="validate">
									<label for="Caccount">帳號</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="password" name="password" placeholder="Your Password..." class="validate">
									<label for="Cpassword">密碼</label>
								</div>
											  
								<button class="btn waves-effect waves-light" type="submit" name="submit">登入
									<i class="material-icons right">send</i>
								</button>
							</form>
						</div>
					</div>
					
					<div id="res" class="col s8 offset-s2">
						<br>
						<h5>餐廳登入</h5>
						<div>
							<form method="post" action="../model/login_check_b.php">
								<div class="input-field col s12">
									<input type="text" id="nameuser" name="nameuser" placeholder="Your Account..." class="validate">
									<label for="Caccount">帳號</label>
								</div>
								<div class="input-field col s12">
									<input type="password" id="password" name="password" placeholder="Your Password..." class="validate">
									<label for="Cpassword">密碼</label>
								</div>
											  
								<button class="btn waves-effect waves-light" type="submit" name="action">登入
									<i class="material-icons right">send</i>
								</button>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<br>
					<div class="col s8 offset-s2 right-align">
						<font size="1">Or you can ..........</font>
						<a href="register.php">前往註冊</a>
						<font size="1"> / </font>
						<a href="index.php">回起始頁面</a>
					</div>
				</div>
			</div>
		</section>
    </div>

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
		<script src="js/init.js"></script>
		<!--初始化-->
		<script>
			$(document).ready(function() {
				$('.parallax').parallax();
			});
		</Script>
		
	</body>

</html>
