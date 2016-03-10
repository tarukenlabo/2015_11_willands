<?php
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	//セッション開始
	session_start();
	
	
	$p_id = $_GET['p_id'];
	
	//データベース設定
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	
	var_dump($_SESSION["post_data"]);
	$post_data = $_SESSION["post_data"];
	echo $post_data["title"];
	
	//サニタイジング
	$title = h($post_data["title"]);
	$cate = h($post_data["cate"]);
	$peaple = h($post_data["peaple"]);
	$price = h($post_data["price"]);
	$sday = h($post_data["sday"]);
	$fday = h($post_data["fday"]);
	$comment = h($post_data["comment"]);


	$stmt = $dbh->prepare("UPDATE post SET P_CAT = :cate, P_TITLE = :title, P_AWORD = :comment, P_PEAPLE = :peaple, P_PRICE = :price, P_SDAY = :sday, P_FDAY = :fday, P_OFLAG = :flag WHERE P_ID = '".$p_id."'");
	$stmt->execute(array(
		'cate'=>$cate,
		'title'=>$title,
		'comment'=>$comment,
		'peaple'=>$peaple,
		'price'=>$price,
		'sday'=>$sday,
		'fday'=>$fday,
		'flag'=>0
	));
	
	header("Location:trip-form_comp.php");
