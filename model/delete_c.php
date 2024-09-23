<?php
	session_start(); 
	require_once 'config.php';

	// array for JSON response
	$response = array();

	$username_cus = $_SESSION['id_c'];

	$message="";

	$sql1 = "DELETE FROM user_customer WHERE username_cus = '$username_cus'";
	$sql2= "DELETE FROM booklist WHERE username_cus = '$username_cus'";
	$sql3= "DELETE FROM comment WHERE username_cus = '$username_cus'";
			
	if ($result1 = $conn->query($sql1) && $result2 = $conn->query($sql2) && $result3 = $conn->query($sql3)) 
	{
		unset($_SESSION['login_c']);
		unset($_SESSION['id_c']);	
		unset($_SESSION['delete_book']);	
		echo "<script>alert('帳號刪除成功'); location.href = '../view/index.php';</script>";
	}
	else
	{
		$message="帳號刪除失敗";
	}			

?>