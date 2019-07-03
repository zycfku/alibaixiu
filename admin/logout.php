<?php 
    session_start();
    unset($_SESSION['nickname']);
	unset($_SESSION["isLogin"]);
	header("location:login.html");
 ?>
