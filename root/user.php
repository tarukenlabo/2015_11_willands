<?php
//ユーザー関数
	require_once("./db_connect.php");

	//ユーザー認証検索：ユーザーID指定
	function search_uauth_by_uid($u_id){

		$db = new cls_db();
		$dbh = $db->db_connect();

		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM u_auth WHERE U_ID=" . $u_id;
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		foreach($stmt as $post) {
		}
		
		return $post;
	}

	//ユーザー情報検索：ユーザーID指定
	function search_uinfo_by_uid($u_id){

		$db = new cls_db();
		$dbh = $db->db_connect();

		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM u_info WHERE U_ID=" . $u_id;
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		foreach($stmt as $post) {
		}
		
		return $post;
	}

	//ユーザー情報一括検索：ユーザーID指定
	function search_user_by_uid($u_id){

		$db = new cls_db();
		$dbh = $db->db_connect();

		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * "
					. "FROM u_auth AS ua "
					. "LEFT JOIN u_info AS ui "
					. "ON (ua.U_ID = ui.U_ID) "
					. "WHERE ua.U_ID=" . $u_id;
		echo $select;

		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		foreach($stmt as $post) {
		}
		
		return $post;
	}


