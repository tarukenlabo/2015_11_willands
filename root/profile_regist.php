<?php
	session_start();
	//入力フォームからパラメータを取得
	$name = $_POST["$name"];
	$age = $_POST["$age"];
	$sex = $_POST["$sex"];
	$self = $_POST["$self"];
	$userId = 1;
	
	$_FILES = $_POST["$icon"];
	
	
	//データベース接続設定
	require_once("./db_connect.php");
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$sql="INSERT INTO u_info(U_ID,U_AGE,U_SEX,U_COMMENT,U_THUMB) values($userId,$age,$sex,'$self',$icon)";
		var_dump( $sql );
	
	$stmt = $dbh->query($sql);
	$stmt->execute();
	
	/*while( $test = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "<pre>";
			var_dump( $test );
			echo "<pre>";
	}*/