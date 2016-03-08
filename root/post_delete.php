<?php
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$id=h($_POST['id']);
	$stmt=$dbh->prepare("DELETE FROM post_check_in WHERE C_ID = ?");
	$stmt->execute(array($id));
	$dbh=null;
