<?php
session_start();
if (isset($_SESSION["login_c"]) && $_SESSION["login_c"] === true) {
	header("Location: index2.php");
	exit;
} else if (isset($_SESSION["login_r"]) && $_SESSION["login_r"] === true) {
	header("Location: res_home.php");
	exit;
} else {
	$index = 1;
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
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
	<link type="text/css" rel="stylesheet" href="css/index.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta charset="utf-8">
	<title>聚食</title>

	<!--分享的時候不會只有連結-->
	<meta property="og:url" content="https://www.your-domain.com/your-page.html" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Your Website Title" />
	<meta property="og:description" content="Your description" />
	<meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />

</head>

<body>

	<!--頁面標題-->
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper deep-orange lighten-3">
				<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回頁首" onclick="topFunction()"><img src="pics/logo5.png"></a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
				</ul>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="help.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回報問題"><i class="material-icons">help_outline</i></a></li>
				</ul>
			</div>
		</nav>
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
				<a><img class="circle" src="pics/unknown.png"></a>
				<a><span class="black-text">請先登入以查看更多內容</span></a>
				<a>
					<p><br></p>
				</a>
			</div>
		</li>

	</ul>

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
			<p>歡迎來到聚食平台 ! 登入即可享有更多功能</p>
		</div>
	</div>

	<!-- 右邊導航 
		<div class="navigation">
			<ul>
				<li><a href="#"><i class="material-icons tiny">local_fire_department</i> 本週HOT</a></li>
				<li><a href="#">Top 1</a></li>
				<li><a href="#">Top 2</a></li>
				<li><a href="#">Top 3</a></li>
			</ul>
		</div>-->

	<!--parallax-->
	<div id="index-banner" class="parallax-container">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
					<br><br><br><br>
					<h5 class="header white-text col s12">聚食，讓聚餐不再費時</h5><br>
					<p class="white-text col s6 offset-s3">&emsp;&emsp;
						在現代快節奏的生活中，我們往往經常忽略了和家人、朋友或同事之間的情感交流，
						而聚餐正是一個可以讓我們重新連結並建立關係的機會。
						在這樣讓人放鬆心情的時刻，
						我們不僅可以共享美食帶來的歡愉，還可以分享生活中的點滴、心情和趣事。
						這樣的交流加深彼此之間的了解和信任，讓關係更加親密和堅實。<br><br>&emsp;&emsp;
						此外，聚餐也是一個機會，讓我們可以忘卻日常瑣事，暫時擺脫壓力和煩惱，放鬆身心，享受當下。
						無論是一頓美食、一杯美酒，或是一份歡笑，都能為我們接下來的每天重新備足體力。<br><br>
						現在，就讓我們相聚在美食吧 !</p>

				</div>
			</div>
		</div>
		<div class="parallax"><img src="pics/foodBG4.jpg"></div>
	</div>

	<!--Search-->
	<div class="container">
		<div class="section">
			<div class="row">
				<form name='search' onclick="return enter()" action='search_check.php' method='POST'>
					<div id="dropdown">
						<input type="text" id="restaurant" name="restaurant" placeholder="Search for a restaurant...">
						<br><br>
						<select id="location" name="location">
							<option value="">--Please choose a location--</option>
							<option value="1">北</option>
							<option value="2">中</option>
							<option value="3">南</option>
						</select>
						<br>
						<select id="type" name="type">
							<option value="">--Please choose a type--</option>
							<option value="1">中式</option>
							<option value="2">西式</option>
							<option value="3">日式</option>
							<option value="4">泰式</option>
							<option value="5">美式</option>
							<option value="6">韓式</option>
						</select>
						<br>
					</div>
					<button type="submit" class="btn waves-effect waves-light" name='action'>
						<i class="material-icons left">search</i>Search
					</button>
				</form>
			</div>
		</div>
	</div>

	<p class="z-depth-5">

	</p>
	<!--About Me Section-->
	<section class="section grey lighten-5 section-about grey-text text-darken-2 scrollspy" id="about">
		<div class="container center">
			<h3>精選分類</h3>
			<h6 class="grey-text text-darken-1">提供各類別精選美食店家</h6>
			<div class="row center">
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/chinese.jpg">
								<div class="overlay"></div>
								<span class="card-title">中式美食</span>
							</div>
						</a>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/west.jpg">
								<div class="overlay"></div>
								<span class="card-title">西式美食</span>
							</div>
						</a>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/japan.jpg">
								<div class="overlay"></div>
								<span class="card-title">日式美食</span>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="row center">
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/thai.jpg">
								<div class="overlay"></div>
								<span class="card-title">泰式美食</span>
							</div>
						</a>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/american.jpg">
								<div class="overlay"></div>
								<span class="card-title">美式美食</span>
							</div>
						</a>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card animated">
						<a href="restaurant_overview.php" onclick="return enter()">
							<div class="card-image">
								<img src="pics/korean.jpg">
								<div class="overlay"></div>
								<span class="card-title">韓式美食</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="parallax-container valign-wrapper">
		<div class="overlay">
			<div class="section">

				<div class="container">
					<div class="carousel carousel-slider center">
						<div class="carousel-fixed-item center">
							<div class="fb-share-button" data-href="https://www.your-domain.com/your-page.html" data-layout="button">
							</div>
							<!--<a class="btn waves-effect white grey-text darken-text-2" href="#!">SHARE</a>-->
						</div>
						<div class="carousel-item white-text valign-wrapper" href="#one!">
							<div class="container">
								<br>
								<h2>Inspiring Quotes</h2><br>
								<h5 class="col s12 light">I am a slow walker, but I never walk backwards.<br>
									<br>— Abraham Lincoln
								</h5>
							</div>
						</div>
						<div class="carousel-item white-text valign-wrapper" href="#two!">
							<div class="container">
								<br>
								<h2>Inspiring Quotes</h2><br>
								<h5 class="col s12 light">Cease to struggle and you cease to live.<br>
									<br>— Thomas Carlyle
								</h5>
							</div>
						</div>
						<div class="carousel-item white-text valign-wrapper" href="#three!">
							<div class="container">
								<br>
								<h2>Inspiring Quotes</h2><br>
								<h5 class="col s12 light">Living without an aim is like sailing without a compass.<br>
									<br>— John Ruskin
								</h5>
							</div>
						</div>
						<div class="carousel-item white-text valign-wrapper" href="#four!">
							<div class="container">
								<br>
								<h2>Inspiring Quotes</h2><br>
								<h5 class="col s12 light">What makes life dreary is the want of motive.<br>
									<br>— George Eliot
								</h5>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="parallax"><img src="pics/foodBG3.jpg"></div>
	</div>


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
					<a href="#"><i class="small material-icons white-text">email</i></a>
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
	<script type="text/javascript" src="js/init.js"></script>
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
	<script type="text/javascript">
		function enter() {
			var index = "<?php echo $index; ?>";
			if (index == 1) {
				swal({
					icon: 'info',
					text: '請先登入以觀看更多',
					buttons: {
						cancel: {
							text: "取消",
							visible: true,
							value: 0
						},
						confirm: {
							text: "登入",
							visible: true,
							value: 1
						}
					}
				}).then((value) => {
					if (value == 1)
						window.location.href = "login.php";
					else
						return false;
				})
				return false;
			}
			return true;
		}
	</script>
</body>

</html>