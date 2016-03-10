<?php
	
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	//セッション開始
	session_start();
	
	$upload_file_path = $_SESSION['photo_path'];
	
	
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
	

	$stmt = $dbh->prepare("UPDATE post SET P_CAT = :cate, P_TITLE = :title, P_AWORD = :comment, P_PEAPLE = :peaple, P_PRICE = :price, P_SDAY = :sday, P_FDAY = :fday, P_OFLAG = :flag, P_EYE = :photo WHERE P_ID = '".$p_id."'");
	$stmt->execute(array(
		'cate'=>$cate,
		'title'=>$title,
		'comment'=>$comment,
		'peaple'=>$peaple,
		'price'=>$price,
		'sday'=>$sday,
		'fday'=>$fday,
		'flag'=>1,
		'photo'=>$upload_file_path
	));
	
	/*
	//post_photoへの登録
	$insert_sql = "UPDATE post SET P_EYE = ".$upload_file_path."WHERE =)";
	$stmt = $dbh->prepare($insert_sql);
	$stmt->execute();*/

	
	//マイページへ
	header("Location:member_page.php");