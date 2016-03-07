<?php
	require "db_connect.php";
	require "ErrorHandling.php";
	
	var_dump($_POST);
	var_dump($_FILES );
	
	$error = new ErrorHandling;
	$e_message;
	
	//ファイルサイズ判定
	if( $error -> fileSizeDecision( (int)$_FILES["uPhoto"]["size"] ) ){
		$e_message[] = "アップロードできるファイルサイズの上限20Mを超えています。";
	}
	
	//ファイル拡張子判定
	if( $error -> fileExtendDecision( (int)$_FILES["uPhoto"]["name"] ) ){
		$e_message[] = "アップロードできるファイルの種類は画像のみです。";
	}
	
	//一つでもエラーがあればリダイレクト
	if( is_array( $e_message ) ){
		header( "Location: ./chek-in_map.php" );
	}


	//データベース接続確立
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh -> query( 'SET NAMES utf8' );
	
	$insert_sql = 'INSERT INTO post_check_in(P_ID,U_ID,C_POSIX,C_POSIY,C_DATE,C_COMMENT,M_ID) VALUES()';

