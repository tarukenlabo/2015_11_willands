<?php
	require_once("./db_connect.php");

	//記事検索：記事ID指定
	function search_id($p_id){

		$db = new cls_db();
		$dbh = $db->db_connect();

		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM post WHERE P_ID=" . $p_id;
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		foreach($stmt as $post) {
		}
		
		return $post;
	}

	//記事検索：カテゴリ指定
	function search_cate($p_cate){

		$db = new cls_db();
		$dbh = $db->db_connect();


		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM post WHERE P_CAT=" . $p_cate;
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		return $stmt;
		
	}

	//記事検索：キーワード指定
	function search_keyword($keyword){

		if ($keyword <> ""){
			$db = new cls_db();
			$dbh = $db->db_connect();


			$dbh->query('SET NAMES utf8');
			
			$select = "SELECT * FROM post AS pst "
						. "LEFT JOIN post_check_in AS chk "
						. "ON (pst.P_ID = chk.P_ID) "
						. "WHERE P_TITLE LIKE '%" . $keyword . "%' "
						. " OR P_AWORD LIKE '%" . $keyword . "%' "
						. " OR C_COMMENT LIKE '%" . $keyword . "%' ";
			
			$stmt = $dbh->prepare($select);
			$stmt->execute();
		}
		
		return $stmt;
		
	}


	//記事検索：ランダムで1件取得
	function search_randum(){

		$db = new cls_db();
		$dbh = $db->db_connect();


		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM post ORDER BY RAND() LIMIT 1=" . $p_id;
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();

		foreach($stmt as $post) {
		}
		
		return $post;
		
	}


	//記事検索：チェックイン情報取得
	function search_checkin($p_id){

			$db = new cls_db();
			$dbh = $db->db_connect();


		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT chk.C_ID, chk.P_ID, chk.U_ID, chk.C_POSIX, chk.C_POSIY, chk.C_DATE, chk.C_COMMENT, "
					. "pht.C_PHOTO "
					. "FROM post_check_in AS chk "
					. "LEFT JOIN post_photo AS pht "
					. "ON (chk.C_ID = pht.C_ID) "
					. "WHERE chk.P_ID = " . $p_id . " "
					. "ORDER BY P_ID";
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();

		var_dump($stmt);

		return $stmt;
		
	}



