<?php
	session_start();
	
	$_SESSION = array();
	
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	
	//echo $_SESSION['u_id'];
	
	header('Location:index.php');
	