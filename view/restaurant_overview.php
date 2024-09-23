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
$count = -1;
if(isset($_GET['action']))
{
	if(isset($_GET["tasterestaurant"])) $tasterestaurant = $_GET["tasterestaurant"]; else $tasterestaurant = "";
	if(isset($_GET["tastelocation"])) $tastelocation = $_GET["tastelocation"]; else $tastelocation = "";
	if(isset($_GET["tastetype"])) $tastetype = $_GET["tastetype"]; else $tastetype = "";

	if(!empty($tasterestaurant)) 
	{
		$sql = "SELECT * 
				FROM intro_res AS I,user_restaurant AS R 
				WHERE 1 = 1";
		
		$sql .= " AND R.name like '%$tasterestaurant%' AND R.username_res = I.username_res ";
		if(!empty($tastelocation)) 
		{
			$sql .= " AND area = '$tastelocation'";
		}
		if(!empty($tastetype)) 
		{
			$sql .= " AND type = '$tastetype'";
		}
	}
	else{
		$sql = "SELECT * 
            FROM intro_res AS I
            WHERE 1 = 1";
		if(!empty($tastelocation)) 
		{
			$sql .= " AND I.area = '$tastelocation'";
		}
		if(!empty($tastetype)) 
		{
			$sql .= " AND I.type = '$tastetype'";
		}
	}


	$result = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);
	//echo"<script>alert('$count');</script>";

	while($row1 = mysqli_fetch_assoc($result))
	{
		$data[] = $row1;
	}

	}	
	$sql4 = "SELECT bin_data, filetype
	FROM imgpic_c
	WHERE username_cus = '$username_cus'";
	$result4 = mysqli_query($conn,$sql4);
	$row4 = mysqli_fetch_assoc($result4);
	if($row4)
	{
		$imageURL17 = 'data:image/' . $row4['filetype'] . ';base64,' . base64_encode($row4['bin_data']);
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
		<link type="text/css" rel="stylesheet" href="css/res_overview.css">

		<!--Let browser know website is optimized for mobile-->	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
		<meta charset="utf-8">
		<title>聚食-OverView</title>
	</head>

    <body>			
		
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a  href="index2.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">restaurant</i>瀏覽餐廳</a>
					<ul id="nav-mobile" class="left hide-on-med-and-down">
						<li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
					</ul>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="index2.php" class="tooltipped" data-position="left" data-delay="50" data-tooltip="回主頁面"><i class="material-icons">house</i></a></li>
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
					<a><img class="circle" src=<?php echo $imageURL17;?>></a>
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
			<a class="btn-floating btn-large tooltipped" onClick="topFunction();" data-position="left" data-delay="50" data-tooltip="回頁首">
				<i class="large material-icons white grey-text">expand_less</i>
			</a><!--
			<br><br>
			
			<a class="btn-floating btn-large deep-orange lighten-3 pulse" id="fav">
				<i class="large material-icons">connect_without_contact</i>
			</a>-->
		</div>

		<!-- Tap Target Structure -->
		<div class="tap-target" data-activates="fav">
			<div class="tap-target-content">
				<h5>提示信息</h5>
				<p>您可以在這一頁瀏覽符合篩選結果的餐廳</p>
			</div>
		</div>
	
		<!--Search-->
		<br><br><br>
		<div class="container">
			<div class="section">
				<div class="row">
					<form id="search" name="search" action="../model/restaurant_overview_my_check.php" method='POST'>
						<div id="dropdown">
							<div class="input-field col s8 offset-s1">
								<input type="text" id="restaurant" name="restaurant" class="validate">
								<label for="address"><i class="material-icons left">search</i>Search for a restaurant...</label>
							</div>
							<br><br>
							<div class="input-field col s4 offset-s1">
								<select id="location" name="location">
									<option value="" > Please choose a location </option>
									<option value="1">北</option>
									<option value="2">中</option>
									<option value="3">南</option>
								</select>
								<label>地區</label>
							</div>
							<div class="input-field col s4">
								<select id="type" name="type">
									<option value="" > Please choose a type </option>
									<option value="1">中式</option>
									<option value="2">西式</option>
									<option value="3">日式</option>
									<option value="4">泰式</option>
									<option value="5">美式</option>
									<option value="6">韓式</option>
								</select>
								<label>類別</label>
							</div>
							<br><br><br>
							<button type="submit" class="btn waves-effect waves-light" name='action'>
								<i class="material-icons left">search</i>Search
							</button>
							<br>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--card-->
		<div class="cards-container" id = "result_search" name = "result_search">
			
		<?php
			if($count == -1)
				echo "請開始搜尋";
			else if($count == 0)
				echo "查無相關結果";
			else{
				for($i=0;$i<$count;$i++){
				$username = $data[$i]['username_res'];
				
				switch ($data[$i]['opening']) {
					case 1:
						$data[$i]['opening'] = "00:00";
					break;
					case 2:
						$data[$i]['opening'] = "02:00";
					break;
					case 3:
						$data[$i]['opening'] = "04:00";
					break;
					case 4:
						$data[$i]['opening'] = "06:00";
					break;
					case 5:
						$data[$i]['opening'] = "08:00";
					break;
					case 6:
						$data[$i]['opening'] = "10:00";
					break;
					case 7:
						$data[$i]['opening'] = "12:00";
					break;
					case 8:
						$data[$i]['opening'] = "14:00";
					break;
					case 9:
						$data[$i]['opening'] = "16:00";
					break;
					case 10:
						$data[$i]['opening'] = "18:00";
					break;
					case 11:
						$data[$i]['opening'] = "20:00";
					break;
					case 12:
						$data[$i]['opening'] = "22:00";
					break;
				}

				switch ($data[$i]['closing']) {
					case 1:
						$data[$i]['closing'] = "00:00";
					break;
					case 2:
						$data[$i]['closing'] = "02:00";
					break;
					case 3:
						$data[$i]['closing'] = "04:00";
					break;
					case 4:
						$data[$i]['closing'] = "06:00";
					break;
					case 5:
						$data[$i]['closing'] = "08:00";
					break;
					case 6:
						$data[$i]['closing'] = "10:00";
					break;
					case 7:
						$data[$i]['closing'] = "12:00";
					break;
					case 8:
						$data[$i]['closing'] = "14:00";
					break;
					case 9:
						$data[$i]['closing'] = "16:00";
					break;
					case 10:
						$data[$i]['closing'] = "18:00";
					break;
					case 11:
						$data[$i]['closing'] = "20:00";
					break;
					case 12:
						$data[$i]['closing'] = "22:00";
					break;
				}
				$sql = "SELECT name
						FROM user_restaurant AS R 
						WHERE username_res = '$username' ";
				$result = mysqli_query($conn,$sql);
				$row2 = mysqli_fetch_assoc($result);

				$sql = "SELECT bin_data, filetype
						FROM imgpic 
						WHERE username_res = '$username' AND description = '餐廳' ";
				$result = mysqli_query($conn,$sql);
				$row3 = mysqli_fetch_assoc($result);
				if($row3)
				{
					$imageURL = 'data:image/' . $row3['filetype'] . ';base64,' . base64_encode($row3['bin_data']);
				}
        	?>
			
            <div class="card" >
				<div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src= <?php echo $imageURL;?> style="width: 100%; height: auto;">
                </div>
                <div class="card-content">
					<!--後端資料放置處-->
					<span class="card-title activator grey-text text-darken-4"><?php echo $row2['name'];?><a class="btn btn-floating info right tooltipped" data-position="top" data-delay="50" data-tooltip="查看餐廳資訊"><i class="material-icons">info</i></a></span>
					<br><div class="divider"></div><br>
					<a class="btn waves-effect waves-light modal-trigger right" href="#modal" onclick="setUsername('<?php echo $data[$i]['username_res']; ?>','<?php echo $data[$i]['opening'];?>','<?php echo $data[$i]['closing'];?>')">直接訂位</a>
					<br>
                </div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i><?php echo $row2['name'];?><!--引入餐廳名字--></span>
					<p><!--引入餐廳基本資訊-->
                    <?php echo $data[$i]['introduction'];?>
					</p>
					<div class="divider"></div><br>
					<span><i class="tiny material-icons">fmd_good</i> 地址 : <?php echo $data[$i]['address'];?><!--echo餐廳地址--></span><br>
					<span><i class="tiny material-icons">phone</i> 聯絡電話 : <?php echo $data[$i]['telephone'];?></span><br>
					<span><i class="tiny material-icons">store</i> 營業時間 : <?php echo $data[$i]['opening'];?> ~ <?php echo $data[$i]['closing'];?></span>
                    <div style="display:none" ><?php echo $data[$i]['username_res']?></div>
					<br><br>
					<a class="btn waves-effect waves-light" href="restaurant_view.php?username_res=<?php echo $data[$i]['username_res'];?>">看更多詳細資訊</a>
				</div>
            </div>
			<?php
				}}
			?>

		</div>
		
		<!-- Modal Structure -->
 		<?php
			/*$sql5 = "SELECT opening , closing FROM intro_res WHERE username_res = '$username'";
			$result5 = mysqli_query($conn,$sql5);
			while ($row5 = mysqli_fetch_assoc($result5))
			{
				$opening = $row5['opening'];
				$closing= $row5['closing'];
			}*/
			
		?>
		<div id="modal" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h5 class="row center" style="color: #FF8966"><b>訂位</b></h5>
				<div class="divider"></div>
				<div class="row">
				<form name="booklist" method="post" action="../model/restaurant_view_check.php">
					<div class="input-field col s10 offset-s1">
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
					<div class="input-field col s10 offset-s1">
						<div class="col s4">
							<label for="bookdate">&emsp;日期 :</label>
						</div>
						<div class="col s8">
							<input type="date" id="bookdate" name="bookdate" required>
						</div>
						<div class="col s8">
							<input type="hidden" id="restaurant_book" name="restaurant_book">
						</div>
					</div>
					<div class="input-field col s10 offset-s1">
						<div class="col s4">
							<label for="start">&emsp;時間 :</label>
						</div>
						<div class="col s8">
							<select id="booktime" name="booktime" required>
								<!--可能把不行的disable掉?-->
								<option value="" disabled selected></option>
								<option value="1">00:00</option>
								<option value="2">02:00</option>
								<option value="3">04:00</option>
								<option value="4">06:00</option>
								<option value="5">08:00</option>
								<option value="6">10:00</option>
								<option value="7">12:00</option>
								<option value="8">14:00</option>
								<option value="9">16:00</option>
								<option value="10">18:00</option>
								<option value="11">20:00</option>
								<option value="12">22:00</option>
								</select>	
						</div>
					</div>
					<div class="input-field col s10 offset-s1">
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


		<!--footer-->
		<footer class="page-footer grey lighten-1" style="margin-top: 60px;">
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
		<script type="text/javascript" src="js/res_view.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
		<!--表單-->
		<script>
			$("#search").submit(function(e) {
			//$("#submit").attr("disabled", true);
			var datas= {
				name: $('#restaurant').val(),
				location: $('#location').val(),
				type: $('#type').val(),
			};
			var query=jQuery.param(datas);
			var form=$('#search');
			var url=form.attr('action');
			//alert(url);
			$.ajax({
				type: "POST",
				url: url,
				data: datas,
				beforeSend:function(){
					$("#result_search").html('<div class="preloader-wrapper big active"><div class="spinner-layer spinner-orange-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>');
					//$("#result_search").html("<span>正在搜尋中......</span>");
				},
				success: function(data) {
					$("#result_search").html(data);
				}
			});
			e.preventDefault(); // 避免將表單直接發送而造成頁面跳轉.
			});
		</script>
		<script>
			function setUsername(username, opening, closing) {
			document.getElementById('restaurant_book').value = username;
			//alert(opening);
			/*const modalElement = document.getElementById('modal');
			const modalInstance = M.Modal.getInstance(modalElement);
			modalInstance.open();

			// 使用setTimeout延遲呼叫disableOptions函式
			setTimeout(function() {
				disableOptions(opening, closing);
			}, 10000); // 調整延遲時間以適應你的需求*/
			}

			/*function disableOptions(opening, closing) {
			const booktimeSelect = document.getElementById("booktime");

			for (let i = 0; i < booktimeSelect.options.length; i++) {
				const option = booktimeSelect.options[i];
				const optionValue = parseInt(option.value);

				if (opening >= optionValue || closing < optionValue) {
				option.disabled = true;
				alert(opening);
				}
			}
			}*/
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