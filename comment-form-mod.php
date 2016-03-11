<?php

	//セッション開始
	session_start();
	//データベース接続設定
	require_once("./db_connect.php");
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	//comment-formからコメントを取得
	$comment=$_POST["comment"];
	
	$u_id = $_SESSION['u_id'];
	$p_id = $_GET['p_id'];
	
	
	//ユーザーコメントを書き込み 
	$sql="INSERT INTO user_post_comment (P_ID,U_ID,UP_COMMENT) values($p_id,$u_id,'".$comment."') ";
	$stmt = $dbh -> prepare( $sql );
	$stmt -> execute();
	
	header('Location:./article.php?P_ID='.$p_id);