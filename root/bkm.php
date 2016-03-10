<?php
	session_start();
	
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	$p_id = h($_GET['p_id']);
	$u_id = h($_SESSION['u_id']);
	
	echo $p_id;
	echo $u_id;
	
	
	$select = "SELECT * FROM bookmark WHERE P_ID = ".$p_id."&& U_ID = ".$u_id;
	$stmt = $dbh->prepare($select);
	$stmt->execute();

	$args = array();
	foreach($stmt as $val){
		$args[] = $val;
	}
	
	var_dump($args);
	$count = count($args);
	echo $count;
	$url = $_SERVER['HTTP_REFERER'];

	if($count == 0){
		$insertBkm = "INSERT INTO bookmark VALUES(".$p_id.",".$u_id.")";
		$stmt = $dbh->prepare($insertBkm);
		$stmt->execute();
		
		header("Location:$url");
	}else{
		header("Location:$url");
	}