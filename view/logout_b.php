<?php
   session_start();
   unset($_SESSION['login_r']);
   unset($_SESSION['id_r']);
   unset($_SESSION['LAST_ACTIVITY']);
   header("Location: index.php")
?>