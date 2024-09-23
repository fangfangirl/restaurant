<?php
	//時區設定
	date_default_timezone_set('Asia/Taipei');
	//主機,帳號, 密碼,資料庫名稱
	$conn = new mysqli("localhost","root","","group9");
	//編碼設定
	$conn->set_charset("utf8");
?>
