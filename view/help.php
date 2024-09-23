<?php unset($_SESSION['delete_book']);?>
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
		<title>聚食-Help</title>
		
	</head>
  
  
	<body>
	
		<!--頁面標題-->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper deep-orange lighten-3">
					<a  href="index2.php" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="回主頁面"><img src="pics/logo5.png"></a>
					<a class="brand-logo center"><i class="material-icons">help_outline</i>回報問題</a>
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
				<p>您可以在此頁將遇到的問題回報給聚食平台</p>
			</div>
		</div>
		
		<br><br>
		<section>
			<div class="container">
				<div class="row">
					<div class="col s12 brown lighten-4">
						<br><br>
						<div class="col s12 brown lighten-5">
							<br>
							<div class="row">
								<div class="col s8 offset-s2">
									<br>
									<h6><b>請填寫以下資訊，聚食平台將盡快為您服務 : </b><h6>
									<div>
										<form name="form_feedback" onsubmit="return enter()" action="../model/help_check.php" method="POST">
											<div class="col s12">
												<h1> </h1>
											</div>
											<div class="input-field col s6">
												<i class="material-icons prefix">account_circle</i>
												<input id="icon_name" type="text" name = 'name'class="validate">
												<label for="icon_name">請填入您的稱呼方式</label>
											</div>
											<div class="input-field col s6">
												<i class="material-icons prefix">phone</i>
												<input id="icon_tel" type="tel" name="telres" class="validate">
												<label for="icon_tel">請填入您的聯絡方式</label>
											</div>
											<div class="input-field col s12">
												<i class="material-icons prefix">mode_edit</i>
												<textarea id="feedback" class="materialize-textarea" name="feedback"></textarea>
												<label for="feedback">請描述您遇到的問題</label>
											</div>

											<div class="right">
												<button class="btn waves-effect waves-light" type="submit" name="action">提交回饋
													<i class="material-icons right">send</i>
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
								
							<div class="col s12">
								<h1> </h1>
							</div>
						</div>
						<div class="col s12">
							<h1> </h1>
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
		<script src="js/init.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script> 
		<script type="text/javascript"> 
			function enter() 
			{ 
				var a=document.forms["form_feedback"]["name"].value;
				var b=document.forms["form_feedback"]["telres"].value;
				var c=document.forms["form_feedback"]["feedback"].value; 
				if(a.length==0 || b.length==0 || c.length==0)
				{ 
					swal({
						icon: 'warning',
						text: '不可以為空',
						button: 'OK!'
					})
					return false; 
				} 
			} 
    	</script> 
	</body>

</html>