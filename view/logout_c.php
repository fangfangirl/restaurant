<?php
   session_start();
   unset($_SESSION['login_c']);
   unset($_SESSION['id_c']);
   unset($_SESSION['LAST_ACTIVITY_c']);
   unset($_SESSION['delete_book']);
   header("Location: index.php")
?>