<?php
session_start();
require_once '../model/config.php';
unset($_SESSION['delete_book']);
if( !isset($_SESSION["login_c"]) || $_SESSION["login_c"]===false)
    {
        header("Location: index.php");
        exit;
    }

$username_cus = $_SESSION['id_c'];

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

 
$sql4 = "SELECT bin_data, filetype
FROM imgpic_c
WHERE username_cus = '$username_cus'";
$result4 = mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_assoc($result4);
if($row4)
{
	$imageURL = 'data:image/' . $row4['filetype'] . ';base64,' . base64_encode($row4['bin_data']);
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
		<title>聚食</title>
		
		<meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Your Website Title" />
		<meta property="og:description"   content="Your description" />
		<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />		
	
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
						<li><span>Welcome! &emsp;</span></li>
						<li><a href="restaurant_overview.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="找更多餐廳"><i class="material-icons">search</i></a></li>
						<li><a href="reservation_info.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="查看已訂位資訊"><i class="material-icons">assignment</i></a></li>
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
					<a><img class="circle" src=<?php echo $imageURL;?>></a>
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
				<p>您可以在這一頁搜尋餐廳並查看個人資料</p>
			</div>
		</div>

		<!-- Tap Target Structure -->
		<div class="tap-target" data-activates="fav">
			<div class="tap-target-content">
				<h5>提示信息</h5>
				<p>您可以在這一頁搜尋餐廳並查看個人資料</p>
			</div>
		</div>
		
		<!-- 右邊導航 
		<div class="navigation">
			<ul>
				<li><a><i class="material-icons tiny">local_fire_department</i> 本週HOT</a></li>
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
					<form name='search' action='restaurant_overview.php' method='get'>
						<div id="dropdown">
							<input type="text" id="restaurant" name="tasterestaurant" placeholder="Search for a restaurant...">
							<br><br>
							<select id="location" name="tastelocation">
							  <option value="">--Please choose a location--</option>
							  <option value="1">北</option>
							  <option value="2">中</option>
							  <option value="3">南</option>
							</select>
							<br>
							<select id="type" name="tastetype">
							  <option value="" >--Please choose a type--</option>
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
							<a href="restaurant_overview.php?tastetype=1&action=">
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
							<a href="restaurant_overview.php?tastetype=2&action=">
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
							<a href="restaurant_overview.php?tastetype=3&action=">
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
							<a href="restaurant_overview.php?tastetype=4&action=">
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
							<a href="restaurant_overview.php?tastetype=5&action=">
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
							<a href="restaurant_overview.php?tastetype=6&action=">
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
								<div class="fb-share-button" 
									data-href="https://www.your-domain.com/your-page.html" 
									data-layout="button">
								</div>
								<!--<a class="btn waves-effect white grey-text darken-text-2" href="#!">SHARE</a>-->
							</div>
							<div class="carousel-item white-text valign-wrapper" href="#one!">
								<div class="container">
									<br><h2>Inspiring Quotes</h2><br>
									<h5 class="col s12 light">I am a slow walker, but I never walk backwards.<br>
									<br>— Abraham Lincoln</h5>
								</div>
							</div>
							<div class="carousel-item white-text valign-wrapper" href="#two!">
								<div class="container">
									<br><h2>Inspiring Quotes</h2><br>
									<h5 class="col s12 light">Cease to struggle and you cease to live.<br>
									<br>— Thomas Carlyle</h5>
								</div>
							</div>
							<div class="carousel-item white-text valign-wrapper" href="#three!">
								<div class="container">
									<br><h2>Inspiring Quotes</h2><br>
									<h5 class="col s12 light">Living without an aim is like sailing without a compass.<br>
									<br>— John Ruskin</h5>
								</div>
							</div>
							<div class="carousel-item white-text valign-wrapper" href="#four!">
								<div class="container">
									<br><h2>Inspiring Quotes</h2><br>
									<h5 class="col s12 light">What makes life dreary is the want of motive.<br>
									<br>— George Eliot</h5>
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
		
		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script>
			function confirmDelete(event) {
			event.preventDefault(); // 阻止链接默认的跳转行为
			swal({
						icon: 'warning',
						title: '確認刪除帳號？',
						text: '此操作將永遠刪除您的帳號！',
						buttons:{
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
					}).then((value)=>{
						if(value==1)
							window.location.href = event.target.href;
						else
							return false;
					}
					)
				}
		</Script>

	</body>

</html>        