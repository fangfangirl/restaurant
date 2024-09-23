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
		<title>聚食-Reservation</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
	
	</head>

    <body>			
		
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回首頁" href="index2.php"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">assignment</i>訂位資訊一覽</a>
					<ul id="nav-mobile" class="left hide-on-med-and-down">
						<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
					</ul>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="restaurant_overview.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="找更多餐廳"><i class="material-icons">search</i></a></li>
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
				<p>您可以在這一頁查看已訂位的資訊</p>
			</div>
		</div>
		
		
        <div class="container" style="margin-top: 60px;">
			
			<form id="book" onsubmit="return false" method="post" action="../model/reservation_info_check.php">
				<div class="row">
					<div class="input-field col s7 offset-s3">
						<input id="bookres" type="text" class="validate" name="bookres" value = "">
						<label for="bookres">輸入餐廳名稱</label>
					</div>
					<div class="input-field col s12 offset-s3">
						<font size="2" style="color: grey;">日期</font>
					</div>
					<div class="input-field col s5 offset-s3">
						<input id="bookdate" type="date" name="bookdate" >
					</div>
					<div class="col s4 right">
						<button class="btn waves-effect waves-light" type="submit" id="submit" name="action"><i class="material-icons left">search</i>Search</button>
					</div>
				</div>
			</form>
			
			<h5 class="search-results-title" style="margin-top: 60px;">訂位搜尋結果</h5>
			<div class="progress" id = "booksearch" name = "booksearch">
				
			</div>
			<div id = "booktable" name = "booktable">
				
				<table class="highlight">
					<thead>
					<tr>
						<th>餐廳名稱</th>
						<th>人數</th>
						<th>日期</th>
						<th>時間</th>
						<th>備註</th>
						<th>修改訂單</th>
					</tr>
					</thead>
					<tbody id="search-results">
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					</tbody>
				</table>
			</div>
        </div>

		<footer class="page-footer grey lighten-1" style="margin-top: 120px;">
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
		
    
		<!-- Initialize datepicker -->
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			var datepicker = document.querySelectorAll('.datepicker');
			var options = {
			format: 'yyyy-mm-dd',
			autoClose: true
			};
			M.Datepicker.init(datepicker, options);
		});
		</script>
        <!--表單-->
		<script>
			$("#book").submit(function(e) {
			//$("#submit").attr("disabled", true);
			var bookdata= {
				bookres: $('#bookres').val(),
				bookdate: $('#bookdate').val(),
			};
			var query=jQuery.param(bookdata);
			var form=$(this);
			var url=form.attr('action');
			//alert(url);
			$.ajax({
				type: "POST",
				url: url,
				data: bookdata,
				beforeSend:function(){
					$("#booksearch").html('<div class="indeterminate"></div>');
					$("#booktable").html('<span>正在搜尋中......</span>');
					
				},
				success: function(data) {
					$("#booksearch").html('<div class="determinate"></div>');
					$("#booktable").html(data);
				}
			});
			e.preventDefault(); // 避免將表單直接發送而造成頁面跳轉.
			});
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
		
	</body>

</html>        