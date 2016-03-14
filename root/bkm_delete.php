<?php
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	session_start();
	
	$p_id = h($_GET['p_id']);
	$u_id = $_SESSION['u_id'];
	
	$delbkm = "DELETE FROM bookmark WHERE P_ID = ".$p_id." && U_ID = ".$u_id;
	$stmt = $dbh->prepare($delbkm);
	$stmt->execute();
	echo $delbkm;
	$url = $_SERVER['HTTP_REFERER'];
	
	header("Location:$url");
