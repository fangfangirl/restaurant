<?php 
session_start();
require_once '../model/config.php';

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

$username_res = $_GET['username_cus'];//看那時的資料

$score = [0,0,0,0,0];
$ratio = [0,0,0,0,0];

$sql3 = "SELECT count(*) AS sum_star , AVG(star) AS avg_star FROM comment WHERE username_res = '$username_res'";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);
$avg_star = $row3['avg_star'];
$sum_star = $row3['sum_star'];
//$count = mysqli_num_rows($result2);
//echo"<script>alert('this is AVG of $avg_star ??');</script>"; 
//echo"<script>alert('this is SUM of $sum_star ??');</script>";
//$score[$i] = $count;
//echo"<script>alert('this is $i_now of $score[$i]');</script>";



for ($i=0;$i<5;$i++)
{
	$i_now = $i + 1;
	$sql2 = "SELECT * FROM comment WHERE username_res = '$username_res' AND star = '$i_now'";
	$result2 = mysqli_query($conn,$sql2);
	$count = mysqli_num_rows($result2);
	//echo"<script>alert('this is $i_now of $count ??');</script>";
	$score[$i] = $count;
	//echo"<script>alert('this is $i_now of $score[$i]');</script>";
	if($sum_star != 0) $ratio[$i] = $score[$i] / $sum_star ;
	else if($sum_star == 0) $ratio[$i] = $score[$i] / 1 ;
	//echo"<script>alert('this is ratio $i_now of $ratio[$i]');</script>";
}


$sql4 = "SELECT * FROM comment WHERE username_res = '$username_res'";
$result4 = mysqli_query($conn,$sql4);
$k = 0;
while($row4 = mysqli_fetch_assoc($result4)){
	$cus_com[$k] = $row4['username_cus'];
	$com_com[$k] = $row4['comment'];
	$star_com[$k] = $row4['star'];
	$k = $k + 1;
}

$sql5 = "SELECT opening , closing FROM intro_res WHERE username_res = '$username_res'";
$result5 = mysqli_query($conn,$sql5);
while ($row5 = mysqli_fetch_assoc($result5))
{
	$opening = $row5['opening'];
	$closing= $row5['closing'];
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
		<link type="text/css" rel="stylesheet" href="css/res_view.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
		<meta charset="utf-8">
		
		<!--看要不要在這裡抓餐廳的名字，不行就維持View也行-->
		<title>View</title>
		
		<style>
			
			/*星星條調整的地方，需要變動width的部分*/
			
			.bar-5 {width: <?php echo $ratio[4]*100 . "%";?>; height: 18px; background-color: #cfefef;}
			.bar-4 {width: <?php echo $ratio[3]*100 . "%";?>; height: 18px; background-color: #99d4d4;}
			.bar-3 {width: <?php echo $ratio[2]*100 . "%";?>; height: 18px; background-color: #66b2b2;}
			.bar-2 {width: <?php echo $ratio[1]*100 . "%";?>; height: 18px; background-color: #3f9191;}
			.bar-1 {width: <?php echo $ratio[0]*100 . "%";?>; height: 18px; background-color: #267c7c;}
			
		</style>
	
	</head>
  
  
	<body>
	
		<!--頁面標題-->
		<div class="navbar">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a  href="index2.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<ul id="nav-mobile" class="left hide-on-med-and-down">
						<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
					</ul>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="help.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回報問題"><i class="material-icons">help_outline</i></a></li>
					</ul>
				</div>
			</nav>
		</div>
		
		<!--floating button-->
		<div class="fixed-action-btn">
			<a class="btn-floating btn-large tooltipped" onClick="topFunction();" data-position="left" data-delay="50" data-tooltip="回頁首">
				<i class="large material-icons white grey-text">expand_less</i>
			</a>
			<br><br>
			<a class="btn-floating btn-large deep-orange lighten-3 pulse" id="fav">
				<i class="large material-icons">connect_without_contact</i>
			</a>
		</div>

		<!-- Tap Target Structure -->
		<div class="tap-target" data-activates="fav">
			<div class="tap-target-content">
				<h5>提示信息</h5>
				<p>您可以在這一頁瀏覽餐廳資訊並訂位</p>
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
					<a><img class="circle" src="pics/unsplash2.jpg"></a>
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
			<li><a href="index.php"><i class="material-icons">logout</i>登出</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="delete.php"><i class="material-icons">delete</i>刪除帳號</a></li>	
		</ul>   

		<!--parallax-->
		<div class="parallax-container">
			<div class="section no-pad-bot">
				<div class="container">
					<div class="inner">
						<h5 class="header white-text col s12">某某餐廳<!--引入餐廳名字--></h5>						
					</div>
				</div>
			</div>
			<!--引入餐廳圖片-->
			<div class="parallax"><img src="pics/foodBG4.jpg"></div>
		</div>
		
		<!--邊邊四條-->
		<div id="mySidenav" class="sidenav">
			<a href="#all" id="about">總覽</a>
			<a href="#info" id="blog">設施</a>
			<a href="#menu" id="projects">菜單</a>
			<a href="#comm" id="contact">評價</a>
		</div>
		
		<!--主要介紹區塊-->
		<section>
			<div class="container">
				<div class="row">
					<div class="col s8">
						<!--總覽-->
						<section id="all">
							<br><br>
							<h6><i class="material-icons" style="color: #546E7A;">shape_line</i><b> 餐廳資訊一覽</b></h6>
							<div class="divider"></div>
							<br>							
							<h5 class="col s8 deep-orange-text text-lighten-3"><b>某某餐廳</b></h5>
							<div class="right">
								<div class="chip">北區<!--地區--></div>
								<div class="chip">韓式料理<!--類別--></div>
							</div>							
							<br><br><br>
							<div class="row">
								<div class="col s11 offset-s1">
									<p class="col s10">
										The Rustic Plate是一家充滿美式鄉村風情的餐廳，
										以其卓越的料理和無與倫比的用餐體驗而聞名。
										我們的菜單包含了傳統美式料理，例如熱狗、漢堡、燒烤和炸雞等，
										以及更具創意的菜式，如燉牛肉和焦糖洋蔥馬鈴薯泥等，
										每一道菜肴都是廚師們精心挑選最新鮮的當地食材，
										以最優秀的技術和熱情烹調而成。
										此外，我們的酒吧提供多款手工調製的特色雞尾酒和精選美國啤酒，
										為您的用餐體驗增添不少樂趣。
										在 The Rustic Plate，您將感受到美國鄉村風情和熱情好客的氛圍，
										享受到美味佳餚和美酒的絕妙搭配，將是一個非常愉悅且難忘的用餐體驗。
									</p>
									<span class="col s12"><i class="material-icons">fmd_good</i> 餐廳地址 : &emsp;新竹市東區大學路1001號<!--echo餐廳地址--></span><br>
									<span class="col s12"><i class="material-icons">phone</i> 聯絡電話 : &emsp;03-0000000</span><br>
									<span class="col s12"><i class="material-icons">store</i> 營業時間 : &emsp;08:00 ~ 20:00</span>
								</div>
							</div>
						</section>
						
						<!--設施-->
						<section id="info">							
							<br><br>
							<h6><i class="material-icons" style="color: #546E7A;">shape_line</i><b> 餐廳設施及相關服務</b></h6>
							<div class="divider"></div>
						
							<div class="row">
								<br>
								<div class="col s12">									
									<dl class="col s5 offset-s1">
										<!--有的打勾，沒有的打叉-->
										<dt><i class="material-icons">paid</i> 支援付款方式 : </dt>
										<dd> &emsp;<i class="material-icons green-text">check_circle_outline</i> &emsp;現金</dd>
										<dd> &emsp;<i class="material-icons red-text">highlight_off</i> &emsp;信用卡</dd>
										<dd> &emsp;<i class="material-icons red-text">highlight_off</i> &emsp;行動支付</dd>
									</dl>
									<dl class="col s6">
										<!--有的再顯示-->
										<dt><i class="material-icons pink-text text-lighten-2">diversity_1</i> 聚食友善 : </dt>
										<dd> &emsp;<i class="material-icons">child_care</i> &emsp;幼童友善</dd>
										<dd> &emsp;<i class="material-icons">accessible</i> &emsp;輪椅友善</dd>
										<dd> &emsp;<i class="material-icons">pets</i> &emsp;寵物友善</dd>
									</dl>
									<dl class="col s5 offset-s1">
										<!--有的打勾，沒有的打叉-->
										<dt><i class="material-icons">category</i> 相關設施 : </dt>
										<dd> &emsp;<i class="material-icons red-text">highlight_off</i> &emsp;停車位</dd>
										<dd> &emsp;<i class="material-icons red-text">highlight_off</i> &emsp;電梯</dd>
										<dd> &emsp;<i class="material-icons green-text">check_circle_outline</i> &emsp;WiFi</dd>
									</dl>
								</div>					
							</div>
						</section>
						
						<!--菜單-->
						<section id="menu">
							<br>
							<h6><i class="material-icons" style="color: #546E7A;">shape_line</i><b> 查看餐廳菜單<b></h6>
							<div class="divider"></div>
							<br><br>
							<img class="materialboxed" width="500" src="pics/foodBG1.jpg">
							<br>
						</section>
						
						<!--評價-->
						<section id="comm">
							<br>
							<h6><i class="material-icons" style="color: #546E7A;">shape_line</i><b> 餐廳整體評價<b></h6>
							<div class="divider"></div>
							
							<div class="row">
								<br><br>
								<div class="col s12 offset-s1">
									<span class="col s4">綜合評分:</span>
									<!--引入餐廳評分，此處舉例4.5分-->
									<span style="color: red; font-size: 40px;"><?php echo number_format($avg_star, 1);?></span>
									<span>&emsp; / 5分</span>
								</div>

								<div class="col s10 offset-s1">
									<hr style="border:3px solid #f1f1f1">

									<!--五星-->
									<div class="side">
										<div> &emsp; 5 <span class="fa fa-star orange-text"></span></div>
									</div>
									<div class="middle">
										<div class="bar-container">
											<div class="bar-5"></div>
										</div>
									</div>
									<div class="side toright">
										<div><?php echo $score[4]?> &emsp; </div>
									</div>
									<!--四星-->
									<div class="side">
										<div> &emsp; 4 <span class="fa fa-star orange-text"></span></div>
									</div>
									<div class="middle">
										<div class="bar-container">
											<div class="bar-4"></div>
										</div>
									</div>
									<div class="side toright">
										<div><?php echo $score[3]?> &emsp; </div>
									</div>
									<!--三星-->
									<div class="side">
										<div> &emsp; 3 <span class="fa fa-star orange-text"></span></div>
									</div>
									<div class="middle">
										<div class="bar-container">
											<div class="bar-3"></div>
										</div>
									</div>
									<div class="side toright">
										<div><?php echo $score[2]?> &emsp; </div>
									</div>
									<!--兩星-->
									<div class="side">
										<div> &emsp; 2 <span class="fa fa-star orange-text"></span></div>
									</div>
									<div class="middle">
										<div class="bar-container">
											<div class="bar-2"></div>
										</div>
									</div>
									<div class="side toright">
										<div><?php echo $score[1]?> &emsp; </div>
									</div>
									<!--一星-->
									<div class="side">
										<div> &emsp; 1 <span class="fa fa-star orange-text"></span></div>
									</div>
									<div class="middle">
										<div class="bar-container">
											<div class="bar-1"></div>
										</div>
									</div>
									<div class="side toright">
										<div><?php echo $score[0]?> &emsp; </div>
									</div>
								</div>	
								
								
								<!--引入標籤文字-->
								<!--<div class="col s12 offset-s2">
									<div class="chip">餐點美味</div>
									<div class="chip">價格適宜</div>
									<div class="chip">氣氛優質</div>
									<div class="chip">服務良好</div>
									<div class="chip">空間寬敞</div>
								</div>-->

								<p> &emsp;</p>
							</div>
							
							<div class="divider"></div>
							<p><br> &emsp;<i class="material-icons">comment</i> 共 <span style="color: blue;"><?php echo $sum_star ?></span> 則評論</p>
							<div class="carousel">
								<?php
								for($i=0;$i<$sum_star;$i++){
								?>
								<a class="carousel-item">
									<div class="card-panel">
										<h6><?php echo $cus_com[$i] ;?><span class="right" style="color: orange;"><i class="tiny material-icons">star</i> <?php echo $star_com[$i]; ?> / 5 <br></span></h6>
										<font class="col offset-s1" style="color: grey;" size="2">
											<?php echo $com_com[$i] ;?>
										</font>
									</div>
								</a>
								<?php
								}
								?>
							</div>
							
							<!--撰寫評論-->
							<!-- Modal Trigger -->
							<a class="waves-effect waves-grey btn-flat modal-trigger right blue-text" href="#modal">我也要發表評論</a>
							<!-- Modal Structure -->
							<div id="modal" class="modal modal-fixed-footer">
								<form method="POST" name="comment_cus" id="comment_cus" action="../model/restaurant_view_star_check.php"> 
									<div class="modal-content">
										<h6><b><br> &emsp;您正在為<font style="color: blue;" size="5"> 某某餐廳 <!--引入餐廳名字--></font>撰寫評論...</b></h6>
										<h1> &emsp;</h1>
										<!--打星星-->
										<div class="rating-box center">
											<div class="rating">
												<span class="fa fa-star-o orange-text"></span>
												<span class="fa fa-star-o orange-text"></span>
												<span class="fa fa-star-o orange-text"></span>
												<span class="fa fa-star-o orange-text"></span>
												<span class="fa fa-star-o orange-text"></span>
											</div>
											<font id="rating-value" style="color: grey;" size="3"></font>
											<input id="starvalue" type="hidden" name="star" value="0">
										</div>
										<br>
										<div class="input-field col s12">
											<i class="material-icons prefix">mode_edit</i>
											<textarea id="textarea" class="materialize-textarea" data-length="30" name="comment"></textarea>
											<label for="textarea">請撰寫您的想法 (請勿超過30字元)</label>
										</div>
									</div>
									<div class="modal-footer">
										<div class="right">
											<button class="modal-action modal-close waves-effect waves-orange btn-flat" type="submit" name="action2">提交評論 
												<i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</section>
						
					</div>
					
					<div class="col s4 card-panel" style="background-color: #FFF4E6; height: 600px;position: sticky; top: 5%; left: 0;">
						<br>
						<h5 class="row center" style="color: #FF8966"><b>訂位</b></h5>
						<div class="divider"></div>
						<br><br>
						<div>
							<form name="booklist" method="post" action="../model/restaurant_view_check.php">
								<div class="input-field col s12">
									<div class="col s4"><label>&emsp;人數 :</label></div>
									<div class="col s8">
										<select id="booknum" name="booknum" required>
											<option value="" disabled selected>0 位</option>
											<option value="1">1位</option>
											<option value="2">2位</option>
											<option value="3">3位</option>
											<option value="4">4位</option>
											<option value="5">5位</option>
											<option value="6">6位</option>
											<option value="7">7位</option>
											<option value="8">8位</option>
											<option value="9">9位</option>
											<option value="10">10位</option>
											<option value="11">11位</option>
											<option value="12">12位</option>
											<option value="13">13位</option>
											<option value="14">14位</option>
											<option value="15">15位</option>
											<option value="16">16位</option>
											<option value="17">17位</option>
											<option value="18">18位</option>
											<option value="19">19位</option>
											<option value="20">20位</option>
										</select>
									</div>
								</div>
								<div class="input-field col s12">
									<div class="col s4">
										<label for="bookdate">&emsp;日期 :</label>
									</div>
									<div class="col s8">
										<input type="date" id="bookdate" name="bookdate" required>
									</div>
								</div>
								<div class="input-field col s12">
									<div class="col s4">
										<label for="start">&emsp;時間 :</label>
									</div>
									<div id="time_ava" name= "time_ava" class="col s8">
										<select id="booktime" name="booktime" required>
											<!--可能把不行的disable掉?-->
											<option value="" disabled selected></option>
											<option value="1" <?php if(isset($opening) && isset($closing)){if($opening >= 1 || $closing < 1) echo 'disabled';}?>>00:00</option>
											<option value="2" <?php if(isset($opening) && isset($closing)){if($opening >= 2 || $closing < 2) echo 'disabled';}?>>02:00</option>
											<option value="3" <?php if(isset($opening) && isset($closing)){if($opening >= 3 || $closing < 3) echo 'disabled';}?>>04:00</option>
											<option value="4" <?php if(isset($opening) && isset($closing)){if($opening >= 4 || $closing < 4) echo 'disabled';}?>>06:00</option>
											<option value="5" <?php if(isset($opening) && isset($closing)){if($opening >= 5 || $closing < 5) echo 'disabled';}?>>08:00</option>
											<option value="6" <?php if(isset($opening) && isset($closing)){if($opening >= 6 || $closing < 6) echo 'disabled';}?>>10:00</option>
											<option value="7" <?php if(isset($opening) && isset($closing)){if($opening >= 7 || $closing < 7) echo 'disabled';}?>>12:00</option>
											<option value="8" <?php if(isset($opening) && isset($closing)){if($opening >= 8 || $closing < 8) echo 'disabled';}?>>14:00</option>
											<option value="9" <?php if(isset($opening) && isset($closing)){if($opening >= 9 || $closing < 9) echo 'disabled';}?>>16:00</option>
											<option value="10" <?php if(isset($opening) && isset($closing)){if($opening >= 10 || $closing < 10) echo 'disabled';}?>>18:00</option>
											<option value="11" <?php if(isset($opening) && isset($closing)){if($opening >= 11 || $closing < 11) echo 'disabled';}?>>20:00</option>
											<option value="12" <?php if(isset($opening) && isset($closing)){if($opening >= 12 || $closing < 12) echo 'disabled';}?>>22:00</option>
										</select>	
									</div>
								</div>
								<div class="input-field col s12">
									<div class="col s4">
										<label for="note">&emsp;備註 :<br>&emsp;(選填)</label>
									</div>
									<div class="col s8">
										<textarea id="note" class="materialize-textarea" data-length="30" name="booknote"></textarea>
									</div>
								</div>
								<div class="col offset-s6">
									<button class="btn waves-effect waves-light" type="submit" name="action1">完成
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>	
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
							E-MAIL : vegetable.c@nycu.edu.tw<br>
							ADDRESS : 新竹市東區大學路1001號<br>
						</p>
					</div>
					<div class="col l4 s12">
						<br><br><br><br>
						&emsp;
						<a href="https://www.facebook.com/jenny.tsai1010"><i class="small material-icons white-text">facebook</i></a>
						&emsp;
						<a  href="mailto:vegetable.c@nycu.edu.tw"><i class="small material-icons white-text">email</i></a>
						&emsp;
						<a href="https://www.youtube.com/@vegetable5356/featured"><i class="small material-icons white-text">slideshow</i></a>
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
		<script type="text/javascript" src="js/res_view.js"></script>
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script src="js/init.js"></script>
		<!--Script-->
		<script>
		/*var bookdate = document.getElementById('bookdate');
		var booktime = document.getElementById('booktime');

		// 添加事件监听器，当日期输入框的值发生变化时执行函数
		bookdate.addEventListener('change', function(){
			//$("#submit").attr("disabled", true);
			var bookdata= {
				bookdate: $('#bookdate').val(),
				booknum: $('#booknum').val(),
				opening: <?php echo $opening?>,
				closing: <?php echo $closing?>
			};
			if($('#booknum').val()){
				var query=jQuery.param(bookdata);
				//var form=$(this);
				var url="../model/check_availability.php";
				alert(url);
				$.ajax({
					type: "POST",
					url: url,
					data: bookdata,
					success: function(data) {
						$("#booktime").html(data);
					},
					error: function() {
						alert("请求发生错误"); // 如果请求失败，显示错误消息
					}
				});
				alert(url);
				//e.preventDefault(); // 避免將表單直接發送而造成頁面跳轉.
			}else {
				swal({
						icon: 'warning',
						text: '請輸入人數，在選擇訂位時間',
						button: 'OK!'
					})
			}
		})*/

		</script>
	</body>

</html>