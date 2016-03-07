<?php
	var_dump($_POST);

	require "db_connect.php";

	//データベース接続確立
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh -> query( 'SET NAMES utf8' );
	
	$insert_sql = INSERT INTO post_check_in(P_ID,U_ID,C_POSIX,C_POSIY,C_DATE,C_COMMENT,M_ID)

