<?php
session_start();
require_once '../model/config.php';

if( !isset($_SESSION["login_r"]) || $_SESSION["login_r"]===false)
    {
        header("Location: index.php");
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

$today = date("Y-m-d");
$sql2 = "SELECT *  FROM booklist WHERE date = '$today' AND username_res='$username_res'";
$result2 = mysqli_query($conn,$sql2);
$count2 = mysqli_num_rows($result2);

$sql3 = "SELECT count(*) AS sum_star , AVG(star) AS avg_star FROM comment WHERE username_res = '$username_res'";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);
$avg_star = $row3['avg_star'];
$sum_star = $row3['sum_star'];

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
					<a><img class="circle" src="pics/unsplash2.jpg"></a>
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
			<li><a href="index.php"><i class="material-icons">logout</i>登出</a></li>
			
			<li><div class="divider"></div></li>
			<li><a href="logout_r.php"><i class="material-icons">delete</i>刪除帳號</a></li>	
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
				<p>您可以在這一頁查看餐廳資料以及顧客訂位資訊</p>
			</div>
		</div>
		
		
        <!--餐廳簡介-->
        <div class="row" style="background-color: #D4C3AA;">
			<div class="col s10 offset-s1">
				<div class="card horizontal z-depth-5" style="top: 20px;">
					<!--圖片-->
					<div class="card-image">
						<img src="pics/res_home.jpg">
					</div>
					<!--內容-->
					<div class="card-stacked">
						<div class="card-content">
								<h4>The Rustic Plate</h4> <!--餐廳名稱-->
							<br>
								<p>The Rustic Plate，一家充滿美式鄉村風情的餐廳，
									以其卓越的料理和無與倫比的用餐體驗而聞名。我們
									的菜單包含了傳統美式料理，例如熱狗、漢堡、燒烤和
									炸雞等，以及更具創意的菜式，如燉牛肉和焦糖洋蔥馬
									鈴薯泥等，每一道菜肴都是廚師們精心挑選最新鮮的當
									地食材，以最優秀的技術和熱情烹調而成。此外，我們
									的酒吧提供多款手工調製的特色雞尾酒和精選美國啤酒
									，為您的用餐體驗增添不少樂趣。在 The Rustic Plate，
									您將感受到美國鄉村風情和熱情好客的氛圍，享受到美味
									佳餚和美酒的絕妙搭配，這將會是一個非常愉悅且難忘的用餐體驗。
								</p><!--餐廳簡介-->
							<br>
								<div class="row">
									<div class="col s5 offset-s1">
										<p>今日訂位人數</p>
										<p><i class="small material-icons">person</i><?php echo $count2;?></p> <!--訂位人數-->
									</div>
									<div class="col s5 offset-s1">
										<p>餐廳評價</p>
										<p><i class="small material-icons">stars</i><?php echo number_format($avg_star, 1);?> / 5</p> <!--評價-->
									</div>
								</div>
						</div>

						<div class="card-action">
							<a href="reviews.php">Customer Reviews</a>
						</div>

					</div>
				</div>
				<p><br><br></p>
			</div>
			
        </div>


        <!--SEARCH-->
		<div style="background-color:white; position: sticky; top: 11%; z-index:99;">
			<div class="container" >
				<div class="row">
					<form name="date" id="form" method="post" action="../model/res_home_check.php">
						<div class="input-field col s10 offset-s1">
							<div class="col s2 offset-s2">
								<p>&emsp;請選擇日期 :</p>
							</div>
							<div class="col s4">
								<input type="date" id="bookdate" name ="bookdate" >
							</div>
							<div class="col s4">
								<button class="btn waves-effect waves-light" type="submit" name="action">查詢
									<i class="material-icons right">search</i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<hr style="border:3px solid #f1f1f1">
		</div>

		
        <!--時段-->
        <div class="row">
			<div class="col s10 offset-s1"> 
				
				<div class="section">
					<h5>00:00-02:00</h5>
					<table class="highlight centered bordered responsive-table">
						<!--橫軸標題-->
						<thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
						</thead>
						<!--內容-->
						<tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="btn waves-effect cyan modal-trigger" href="#modal0">備註</a>

									<!-- Modal Structure -->
									<div id="modal0" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				
				<div class="section">
					<h5>02:00-04:00</h5>
					<table class="highlight centered bordered responsive-table">
						<!--橫軸標題-->
						<thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
						</thead>
						<!--內容-->
						<tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal1">備註</a>

									<!-- Modal Structure -->
									<div id="modal1" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="section">
					<h5>04:00-06:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal2">備註</a>

									<!-- Modal Structure -->
									<div id="modal2" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
            
			
				<div class="section">
					<h5>06:00-08:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal3">備註</a>

									<!-- Modal Structure -->
									<div id="modal3" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>

				<div class="section">
					<h5>08:00-10:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal4">備註</a>

									<!-- Modal Structure -->
									<div id="modal4" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>

				<div class="section">
					<h5>10:00-12:00</h5>
					<table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal5">備註</a>

									<!-- Modal Structure -->
									<div id="modal5" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
            

				<div class="section">
					<h5>12:00-14:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal6">備註</a>

									<!-- Modal Structure -->
									<div id="modal6" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>


				<div class="section">
					<h5>12:00-14:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal7">備註</a>

									<!-- Modal Structure -->
									<div id="modal7" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
       
	   
				<div class="section">
					<h5>14:00-16:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal8">備註</a>

									<!-- Modal Structure -->
									<div id="modal8" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
        

				<div class="section">
					<h5>16:00-18:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
                        <tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal9">備註</a>

									<!-- Modal Structure -->
									<div id="modal9" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
      

				<div class="section">
					<h5>18:00-20:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal10">備註</a>

									<!-- Modal Structure -->
									<div id="modal10" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
        
		
				<div class="section">
					<h5>20:00-22:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal11">備註</a>

									<!-- Modal Structure -->
									<div id="modal11" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
       

				<div class="section">
					<h5>22:00-24:00</h5>
                    <table class="highlight centered bordered responsive-table">
                        <!--橫軸標題-->
                        <thead>
							<tr>
								<th>訂位人姓名</th>
								<th>性別</th>
								<th>訂位時間</th>
								<th>聯絡電話</th>
								<th>訂位人數(人)</th>
								<th>備註</th>
							</tr>
                        </thead>
                        <!--內容-->
                        <tbody>
							<tr>
								<td>王小明</td>
								<td>男</td>
								<td>11:30</td>
								<td>0911222333</td>
								<td>4</td>
								<td>
									<!--彈出評論-->
									<!-- Modal Trigger -->
									<a class="waves-effect cyan btn modal-trigger" href="#modal12">備註</a>

									<!-- Modal Structure -->
									<div id="modal12" class="modal">
										<div class="modal-content">
											<h4>特殊需求</h4><br>
											<p>無特殊需求</p>
										</div>

										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
										</div>
									</div>
								</td>
							</tr>
                        </tbody>
                    </table>
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
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
    </body>

</html>        

