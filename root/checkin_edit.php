<?php
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$id=h($_POST['id']);
	$title=h($_POST['title']);
	$comment=h($_POST['comment']);
	$stmt=$dbh->prepare("UPDATE post_check_in SET C_TITLE = :title, C_COMMENT = :comment WHERE C_ID = :id");
	$stmt->execute(array(
		'title'=>$title,
		'comment'=>$comment,
		'id'=>$id
	));
