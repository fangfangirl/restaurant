
<?php
require_once 'config.php';
session_start();

    $query = [
     'booknum' => $_GET["number"],
     'bookdate' => $_GET["date"],
     'booktime' => $_GET["time"],
     'booknote' => $_GET["remark"]
    ];
    $restaurant = $_GET["id_r"];
    echo"<script>alert('哇哇哇 : $restaurant');</script>";
    $customer = $_SESSION['id_c'];
    deleteData($restaurant, $customer, $query['booknum'], $query['bookdate'], $query['booktime'], $query['booknote'], $conn);

function deleteData($bookres, $bookcus, $booknum, $bookdate, $booktime, $booknote, $conn)
{
	$sql1 = "DELETE FROM booklist WHERE username_res = '$bookres' AND username_cus = '$bookcus' AND number = '$booknum' AND booktime ='$booktime' AND date = '$bookdate' AND remark = '$booknote'";
	
	if ($result1 = $conn->query($sql1)) 
	{		
        unset($_SESSION['delete_book']);
		echo "<script>alert('刪除成功'); location.href = '../view/reservation_info.php';</script>";
	}	
    else{
        echo "<script>alert('查無該筆資料'); location.href = '../view/reservation_info.php';</script>";
    }
}
function alert1($message,$address)
{
    echo"<script>
    alert('$message');
    location.href='$address';
    </script>";
    return false;
}

mysqli_close($conn);
?>