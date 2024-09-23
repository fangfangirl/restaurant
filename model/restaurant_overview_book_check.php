<?php
require_once 'config.php';
session_start();

//echo"<script>alert('有近來');</script>";	
$username_res = $_POST['username'];
$sql5 = "SELECT opening , closing FROM intro_res WHERE username_res = '$username_res'";	
$result5 = mysqli_query($conn,$sql5);
while ($row5 = mysqli_fetch_assoc($result5))	
{		
    $opening = $row5['opening'];		
    $closing= $row5['closing'];
}

?>

<div class="col s4">
	<label for="start">&emsp;時間 :</label>
</div>
<div class="col s8">
	<select id="booktime" name="booktime" required>
		<!--可能把不行的disable掉?-->
		<option value="" disabled selected></option>
		<option value="1" <?php if(isset($opening) && isset($closing)){if($opening >= 1 || $closing < 1) echo 'disabled';}?>>00:00</option>
		<option value="2" <?php if(isset($opening) && isset($closing)){if($opening >= 2 || $closing < 2) echo 'disabled';}?>>02:00</option>
		<option value="3" <?php if(isset($opening) && isset($closing)){if($opening >= 3 || $closing < 3) echo 'disabled';}?>>04:00</option>
		<option value="4" <?php if(isset($opening) && isset($closing)){if($opening >= 4 || $closing < 4) echo 'disabled';}?>>06:00</option>
		<option value="5" <?php if(isset($opening) && isset($closing)){if($opening >= 5 || $closing < 5) echo 'disabled';}?>>08:00</option>
		<option value="6" <?php if(isset($opening) && isset($closing)){if($opening >= 6 || $closing < 6) echo 'disabled';}?>>10:00</option>
		<option value="7" <?php if(isset($opening) && isset($closing)){if($opening >= 7 || $closing < 7) echo 'disabled';}?>>12:00</option>
		<option value="8" <?php if(isset($opening) && isset($closing)){if($opening >= 8 || $closing < 8) echo 'disabled';}?>>14:00</option>
		<option value="9" <?php if(isset($opening) && isset($closing)){if($opening >= 9 || $closing < 9) echo 'disabled';}?>>16:00</option>
		<option value="10" <?php if(isset($opening) && isset($closing)){if($opening >= 10 || $closing < 10) echo 'disabled';}?>>18:00</option>
		<option value="11" <?php if(isset($opening) && isset($closing)){if($opening >= 11 || $closing < 11) echo 'disabled';}?>>20:00</option>
		<option value="12" <?php if(isset($opening) && isset($closing)){if($opening >= 12 || $closing < 12) echo 'disabled';}?>>22:00</option>
	</select>	
</div>