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
        $name = $row['name'];
 		$username = $row['username_res'];
		$email = $row['email'];
		$phone = $row['telephone']; 
    }
 }


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

$sql5 = "SELECT bin_data, filetype
 FROM imgpic 
 WHERE username_res = '$username_res' AND description = '餐廳' ";
$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_assoc($result5);
if($row5)
{
$imageURL = 'data:image/' . $row5['filetype'] . ';base64,' . base64_encode($row5['bin_data']);
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
		<meta charset="utf-8">
		<title>聚食-Reviews</title>
		
    </head>

    <body>			
		
		
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a href="res_home.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<ul id="nav-mobile" class="left hide-on-med-and-down">
						<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
					</ul>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="res_home.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回主頁面"><i class="material-icons">house</i></a></li>
						<li><a href="history.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="查看歷史資訊"><i class="material-icons">history</i></a></li>
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
                    <a class="collapsible-header">檢視餐廳資料<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
						<!--引入帳戶資訊-->
                        <li><a>&emsp;&emsp;&emsp;名稱: &emsp;<?php echo $name;?></a></li>
                        <li><a>&emsp;&emsp;&emsp;電話: &emsp;<?php echo $phone;?></a></li>
                        <li><a>&emsp;&emsp;&emsp;電子郵件: &emsp;<?php echo $email;?></a></li>
						<li><a>&emsp;&emsp;&emsp;帳號: &emsp;<?php echo $username;?></a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
            </li>
			
			<li><div class="divider"></div></li>
			<li><a href="update_ResInfo.php"><i class="material-icons">update</i>更新餐廳資料</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="update_ResAccount.php"><i class="material-icons">edit</i>修改帳戶資訊</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="logout_b.php"><i class="material-icons">logout</i>登出</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="../model/delete_b.php" onclick=confirmDelete(event) ><i class="material-icons">delete</i>刪除帳號</a></li>	
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
				<p>您可以在這一頁查看顧客給予的評論</p>
			</div>
		</div>
		

        <div class="row" style="background-color: #D4C3AA; height: 360px;">
			<div class="col s10 offset-s1">
				<div class="card z-depth-5" style="margin-top: 80px;">
					<div class="card-content" style="height:200px">
						<div class="col s2 offset-s2">
							<img src=<?php echo $imageURL;?> class="circle responsive-img" style="position: absolute; width: 150px; height: 150px; top: 5; left: 5; object-fit: cover;">  
						</div>
						<div class="col s5 offset-s1">
							<h4><?php echo $name;?></h4> <br>
							<div class="col s6">
								<p>餐廳評價</p>
								<h5 class="right orange-text"><i class="material-icons">stars</i> <?php echo number_format($avg_star, 1);?> / 5</h5> <!--評價-->
							</div>
							<div class="col s6">
								<p>總評論數</p>
								<h5 class="right orange-text"><i class="material-icons">comment</i> <?php echo $sum_star;?>則</h5> <!--評價-->
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>

		
		<!--評論-->
		<div class="row">
			<div class="col s10 offset-s1">
				<div class="card">
					
					<div class="card-tabs">
					<ul class="tabs tabs-fixed-width">
						<li class="tab"><a class="active" href="#five"><font size="3">5 <span class="fa fa-star orange-text"></span></font></a></li>
						<li class="tab"><a href="#four"><font size="3">4 <span class="fa fa-star orange-text"></span></font></a></li>
						<li class="tab"><a href="#three"><font size="3">3 <span class="fa fa-star orange-text"></span></font></a></li>
						<li class="tab"><a href="#two"><font size="3">2 <span class="fa fa-star orange-text"></span></font></a></li>
						<li class="tab"><a href="#one"><font size="3">1 <span class="fa fa-star orange-text"></span></font></li>
					</ul>
					</div>

					<div class="card-content ">
						<!--5-->	
						<div id="five">
							<div class="row">
								<?php
									for($k=0;$k<$sum_star;$k++)
									{
										if($star_com[$k] == 5){
								?>
								<div class="col s4">
									<div class="card" >
										<div class="card-content black-text" style="height:250px">
											<span class="card-title"><?php echo $cus_com[$k];?></span>
											<p><?php echo $com_com[$k];?></p>
										</div>
									</div>
								</div>
								<?php
									}}
								?>
								
							</div>
						</div>

						<!--4-->	
						<div id="four">
							<div class="row">
								<?php
									for($k=0;$k<$sum_star;$k++)
									{
										if($star_com[$k] == 4){
								?>
								<div class="col s4">
									<div class="card" >
										<div class="card-content black-text" style="height:250px">
											<span class="card-title"><?php echo $cus_com[$k];?></span>
											<p><?php echo $com_com[$k];?></p>
										</div>
									</div>
								</div>
								<?php
									}}
								?>
							</div>	
						</div>

						<!--3-->	
						<div id="three">
							<div class="row">
								<?php
									for($k=0;$k<$sum_star;$k++)
									{
										if($star_com[$k] == 3){
								?>
								<div class="col s4">
									<div class="card" >
										<div class="card-content black-text" style="height:250px">
											<span class="card-title"><?php echo $cus_com[$k];?></span>
											<p><?php echo $com_com[$k];?></p>
										</div>
									</div>
								</div>
								<?php
									}}
								?>
							</div>	
						</div>

						<!--2-->	
						<div id="two">
							<div class="row">
								<?php
									for($k=0;$k<$sum_star;$k++)
									{
										if($star_com[$k] == 2){
								?>
								<div class="col s4">
									<div class="card" >
										<div class="card-content black-text" style="height:250px">
											<span class="card-title"><?php echo $cus_com[$k];?></span>
											<p><?php echo $com_com[$k];?></p>
										</div>
									</div>
								</div>
								<?php
									}}
								?>
							</div>	
						</div>

						<!--1-->	
						<div id="one">
							<div class="row">
								<?php
									for($k=0;$k<$sum_star;$k++)
									{
										if($star_com[$k] == 1){
								?>
								<div class="col s4">
									<div class="card" >
										<div class="card-content black-text" style="height:250px">
											<span class="card-title"><?php echo $cus_com[$k];?></span>
											<p><?php echo $com_com[$k];?></p>
										</div>
									</div>
								</div>
								<?php
									}}
								?>
							</div>	
						</div>
					</div>
				</div>
			</div>
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
		<script type="text/javascript" src="js/init.js"></script>
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