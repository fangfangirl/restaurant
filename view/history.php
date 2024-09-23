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
 $today = date("Y-m-d", strtotime("-1 day"));
 
$sql1 = "SELECT bin_data, filetype
 FROM imgpic 
 WHERE username_res = '$username_res' AND description = '餐廳' ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
if($row1)
{
	$imageURL = 'data:image/' . $row1['filetype'] . ';base64,' . base64_encode($row1['bin_data']);
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
		<title>聚食-History</title>
		
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
						<li><a href="reviews.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="查看顧客評論"><i class="material-icons">comment</i></a></li>
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
		
		<!--parallax-->
		<div class="parallax-container">
			<div class="section no-pad-bot">
				<div class="container">
					<div class="inner">
						<h5 class="header white-text col s12"><?php echo $name; ?></h5>						
					</div>
				</div>
			</div>
			<!--引入餐廳圖片-->
			<?php if (!empty($imageURL)): ?>
				<div class="parallax">
					<img src="<?php echo $imageURL; ?>" alt="餐廳圖片" style="width: 100%; height: auto;">
				</div>
			<?php endif; ?>
		</div>
      
		
		<!--主要區域-->
		<section>
			<!--SEARCH-->
			<div style="background-color:white; margin-top: 30px;">
				<div class="container" >
					<div class="row">
						<form name="search_book" id="search_book" method="post" action="../model/history_check.php">
							
							<div class="col s8 offset-s4">
								<p>請選擇欲查詢日期 :</p>
							</div>
			
							<div class="input-field col s8 offset-s4">
								<div class="col s5">
									<input type="date" id="bookdate" name ="bookdate" value=<?php echo $today;?>>
								</div>
								<div class="col s3">
									<button class="btn waves-effect waves-light" type="submit" name="action" style="width: 30px;">
										<i class="material-icons">search</i>
									</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>

			<div class="container" >
				<div class="row">
					<div id="book_r" class="col s12" style=" padding: 30px;">
						
					</div>
				</div>
			</div>
		</section>
		
		
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
		
		<!--表單-->
		<script>
			$("#search_book").submit(function(e) {
			//$("#submit").attr("disabled", true);
			var datas= {
				date: $('#bookdate').val(),
			};
			var query=jQuery.param(datas);
			var form=$('#search_book');
			var url=form.attr('action');
			//alert(url);
			$.ajax({
				type: "POST",
				url: url,
				data: datas,
				beforeSend:function(){
					$("#book_r").html('<span class="loading-message">正在搜尋中......</span>');
				},
				success: function(data) {
					var returnedData = data;
					$("#book_r").html(returnedData);
					$("#book_r").html('<canvas id="myChart" style="width:100%;"></canvas>');
					var cleanedData = returnedData.replace(/[^\d,]/g, ''); // 去除非数字字符
					var dataArray = cleanedData.split(","); // 将字符串拆分为数组
					var yValues = dataArray.map(Number); // 将数组中的元素转换为数字
					//alert(yValues );
					var xValues = ["00:00","02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00"];
			
					//這邊要放對應的客流量，順序跟上面的時間是一樣的
					
					var barColors = "brown";

					new Chart("myChart", {
					type: "bar",
					data: {
						labels: xValues,
						datasets: [{
						backgroundColor: barColors,
						data: yValues
						}]
					},
					options: {
						legend: {display: false},
						title: {
						display: true,
						text: "每時段客流量"
						}
					}
					});
				}
			});
			e.preventDefault(); // 避免將表單直接發送而造成頁面跳轉.
			});
		</script>

		<!--Bar-->
		<script>
			var xValues = ["00:00","02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00"];
			
			//這邊要放對應的客流量，順序跟上面的時間是一樣的
			var yValues = [0,0,0,0,0,15,12,15,22,44,12,150];
			var barColors = "brown";

			new Chart("myChart", {
			type: "bar",
			data: {
				labels: xValues,
				datasets: [{
				backgroundColor: barColors,
				data: yValues
				}]
			},
			options: {
				legend: {display: false},
				title: {
				display: true,
				text: "每時段客流量"
				}
			}
			});
		</script>

		<!--時間不可以選之後的-->
		<script>
			var data_now = new Date();
			var year = data_now.getFullYear();
			var month = data_now.getMonth()+1 <10 ? "0" + (data_now.getMonth()+1) : (data_now.getMonth()+1);
			var date = data_now.getDate() <10 ? "0" + (data_now.getDate()-1) : (data_now.getDate()-1);
			$("#bookdate").attr("max",year+"-"+month+"-"+date);
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

