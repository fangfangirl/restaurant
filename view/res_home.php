<?php
session_start();
require_once '../model/config.php';

if(!isset($_SESSION["login_r"]) || $_SESSION["login_r"]===false)
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

$today = date("Y-m-d");
$sql2 = "SELECT sum(number) AS sum  FROM booklist WHERE date = '$today' AND username_res='$username_res'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$count2 = $row2['sum'];
//echo"<script>alert('$count2 嗎?');</script>";

$sql3 = "SELECT count(*) AS sum_star , AVG(star) AS avg_star FROM comment WHERE username_res = '$username_res'";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);
$avg_star = $row3['avg_star'];
$sum_star = $row3['sum_star'];

$sql4 = "SELECT bin_data, filetype
 FROM imgpic 
 WHERE username_res = '$username_res' AND description = '餐廳' ";
$result4 = mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_assoc($result4);
if($row4)
{
$imageURL = 'data:image/' . $row4['filetype'] . ';base64,' . base64_encode($row4['bin_data']);
}

$sql5 = "SELECT * 
            FROM intro_res 
            WHERE username_res = '$username_res'";
$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_assoc($result5);

/*回推顧客來時客流*/


/*// 設定目標日期
$targetDate = date('Y-m-d');

// 取得目標日期的星期幾
$targetDay = date('w', strtotime($targetDate));

// 計算目標日期所在星期的起始日期和結束日期
$startDate = date('m-d', strtotime($targetDate . ' -' . ($targetDay - 1) . ' days')); // 將日期設定為該星期的星期一
$endDate = date('m-d', strtotime($targetDate . ' +' . (7 - $targetDay) . ' days')); // 將日期設定為該星期的星期日

// 取得起始日期和結束日期之間的所有日期
$allDates = [];
$currentDate = DateTime::createFromFormat('m-d', $startDate);

// 遞增處理日期，直到達到或超過結束日期
while ($currentDate->format('m-d') <= $endDate) {
    $allDates[] = $currentDate->format('m-d');
    $currentDate->add(new DateInterval('P1D'));
}*/

// 設定目標日期
$targetDate = date('Y-m-d');

// 取得未來6天的日期
$allDates = [];
$currentDate = DateTime::createFromFormat('Y-m-d', $targetDate);

// 輸出今天的日期
$allDates[] = $currentDate->format('m-d');
$allDates2[] = $currentDate->format('Y-m-d');

// 遞增處理日期，取得未來6天的日期
for ($i = 0; $i < 6; $i++) {
    $currentDate->add(new DateInterval('P1D'));
    $allDates[] = $currentDate->format('m-d');
	$allDates2[] = $currentDate->format('Y-m-d');
}
$count6 = [0,0,0,0,0,0];
for ($i = 0; $i < 6; $i++) {
	//echo"<script>alert('$allDates2[$i] 嗎?');</script>";
    $sql6 = "SELECT sum(number) AS sum  FROM booklist WHERE date = '$allDates2[$i]' AND username_res='$username_res'";
	$result6 = mysqli_query($conn,$sql6);
	$row6 = mysqli_fetch_assoc($result6);
	if(empty($row6['sum'])) $count6[$i] = 0; else $count6[$i] = $row6['sum'];
	//echo"<script>alert('$count6[$i] 嗎?');</script>";
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
		<title>聚食-ResHome</title>
		
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
						<li><a href="history.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="查看歷史資訊"><i class="material-icons">history</i></a></li>
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
				<div class="card horizontal z-depth-5" style="top: 43px;">
					<!--圖片-->
					<div class="card-image">
						<img src=<?php echo $imageURL;?> style="width: 100%; height: auto; top: 75px;">
					</div>
					<!--內容-->
					<div class="card-stacked">
						<div class="card-content">
								<h4><?php echo $name;?></h4> <!--餐廳名稱-->
							<br>
								<p><?php echo $row5['introduction'];?>
								</p><!--餐廳簡介-->
							<br>
								<div class="row">
									<div class="col s5 offset-s1">
										<p>今日訂位人數</p>
										<p><i class="small material-icons">person</i><?php echo str_pad($count2, 2, '0', STR_PAD_LEFT);?></p> <!--訂位人數-->
									</div>
									<div class="col s5 offset-s1">
										<p>餐廳評價</p>
										<p><i class="small material-icons">stars</i><?php echo number_format($avg_star, 1);?> / 5</p> <!--評價-->
									</div>
								</div>
						</div>

						<!--<div class="card-action">
							<a href="reviews.php">Customer Reviews</a>
						</div>-->

					</div>
				</div>
				<p><br><br></p>
			</div>
        </div>

		<!--顯示未來六天訂位人數-->
		<div class="container">
			<div class="row">
				<div class="col s10 offset-s1">
					<div class="col s10 offset-s2">
						<p>未來6天訂位人數</p>
					</div>
				</div>
				<div class="col s6 offset-s3">
					<!--d+1-->
					<div class="col s2 center" style="background-color:#FFE4CA; border: 2px solid #FFE4CA;">
						<a data-value=<?php echo $allDates2[0];?> onclick="confirm('<?php echo $allDates2[0]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[0];?><i class="small material-icons">person</i><?php echo str_pad($count6[0], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
					<!--d+2-->
					<div class="col s2 center" style="border: 2px solid #FFAC81;">
						<a data-value=<?php echo $allDates2[1];?> onclick="confirm('<?php echo $allDates2[1]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[1];?><i class="small material-icons">person</i><?php echo str_pad($count6[1], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
					<!--d+3-->
					<div class="col s2 center" style="background-color:#FFE4CA; border: 2px solid #FFE4CA;">
						<a data-value=<?php echo $allDates2[2];?> onclick="confirm('<?php echo $allDates2[2]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[2];?><i class="small material-icons">person</i><?php echo str_pad($count6[2], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
					<!--d+4-->
					<div class="col s2 center" style="border: 2px solid #FFAC81;">
						<a data-value=<?php echo $allDates2[3];?> onclick="confirm('<?php echo $allDates2[3]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[3];?><i class="small material-icons">person</i><?php echo str_pad($count6[3], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
					<!--d+5-->
					<div class="col s2 center" style="background-color:#FFE4CA; border: 2px solid #FFE4CA;">
						<a data-value=<?php echo $allDates2[4];?> onclick="confirm('<?php echo $allDates2[4]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[4];?><i class="small material-icons">person</i><?php echo str_pad($count6[4], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
					<!--d+6-->
					<div class="col s2 center" style="border: 2px solid #FFAC81;">
						<a data-value=<?php echo $allDates2[5];?> onclick="confirm('<?php echo $allDates2[5]; ?>')" href="../model/res_home_check.php" class="tooltipped myclick" data-position="bottom" data-delay="50" data-tooltip="點擊即可查詢詳細資訊"><!--這邊匯入日期--><p class="grey-text text-darken-3"><?php echo $allDates[5];?><i class="small material-icons">person</i><?php echo str_pad($count6[5], 2, '0', STR_PAD_LEFT);?></p></a> <!--訂位人數-->
					</div>
				</div>
			</div>
		</div>


        <!--SEARCH-->
		<div style="background-color:white; position: sticky; top: 11%; z-index:99;">
			<div class="container" >
				<div class="row">
					<form name="search_book" id="search_book" method="post" action="../model/res_home_check.php">
						<div class="input-field col s10 offset-s1">
							<div class="col s2 offset-s2">
								<p>&emsp;請選擇日期 :</p>
							</div>
							<div class="col s4">
								<input type="date" id="bookdate" name ="bookdate" value=<?php echo $today;?>>
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
			<div class="col s10 offset-s1" name="book_r" id="book_r"> 
			</div>
			<!--modal-->
			<div id="modal" name="modal" class="modal">
					<div class="modal-content">
						<h4>特殊需求</h4>
						<hr style="border:3px solid #f1f1f1"><br>
						<font id="restaurant_remark" name="restaurant_remark" size="4"></font>
					</div>

					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
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
					$("#book_r").html("<span>正在搜尋中......</span>");
				},
				success: function(data) {
					$("#book_r").html(data);
				}
			});
			e.preventDefault(); // 避免將表單直接發送而造成頁面跳轉.
			});
		</script>

		<!--按鈕-->
		<script>
			$(document).ready(function() {
				$('.myclick').click(function(e) {
					e.preventDefault(); // 防止連結點擊後的預設行為
					//var value = $(this).data('value');
					var datas = {
						date: $(this).data('value'),
					};
					var query = jQuery.param(datas);
					var url = $(this).attr('href');

					$.ajax({
						type: "POST",
						url: url,
						data: datas,
						beforeSend: function() {
							$("#book_r").html("<span>正在搜尋中......</span>");
						},
						success: function(data) {
							$("#book_r").html(data);
						}
					});
				});
			});
		</script>

		<script>
			function setremark(remark) {
				document.getElementById('restaurant_remark').innerHTML = remark;
				//alert(remark);
			}
		</script>
		<script>
			var data_now = new Date();
			var year = data_now.getFullYear();
			var month = data_now.getMonth()+1 <10 ? "0" + (data_now.getMonth()+1) : (data_now.getMonth()+1);
			var date = data_now.getDate() <10 ? "0" + data_now.getDate() : data_now.getDate();
			$("#bookdate").attr("min",year+"-"+month+"-"+date);
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
		<script>
			function confirm(data1) {
			document.getElementById("bookdate").value = data1;
			}
		</script>
    </body>

</html>        

