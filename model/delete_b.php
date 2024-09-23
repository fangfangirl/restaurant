<?php
	session_start(); 
	require_once 'config.php';

	// array for JSON response
	$response = array();

	$username_res = $_SESSION['id_r'];

	$message="";

	//$sql1= "DELETE FROM help_check WHERE name in (SELECT name FROM user_restaurant WHERE username_res = '$username_res')";	
	$sql1 = "DELETE FROM intro_res WHERE username_res = '$username_res'";
	$sql2= "DELETE FROM imgpic WHERE username_res = '$username_res'";
	$sql3= "DELETE FROM booklist WHERE username_res = '$username_res'";
	$sql4= "DELETE FROM comment WHERE username_res = '$username_res'";
	$sql5 = "DELETE FROM user_restaurant WHERE username_res = '$username_res'";
	if ($result1 = $conn->query($sql1) && $result2 = $conn->query($sql2) && $result3 = $conn->query($sql3) && $result4 = $conn->query($sql4) && $result5 = $conn->query($sql5)) 
	{
		unset($_SESSION['login_r']);
		unset($_SESSION['login_check']);
		unset($_SESSION['id_r']);		
		echo "<script>alert('帳號刪除成功'); location.href = '../view/index.php';</script>";
	}
	else
	{
		$message="帳號刪除失敗";
	}			

?>