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
			
			$select = "SELECT * FROM post WHERE P_TITLE LIKE '%" . $keyword . "%' "
						. " OR P_AWORD LIKE '%" . $keyword . "%' ";
			
			$stmt = $dbh->prepare($select);
			$stmt->execute();
		}
		
		return $stmt;
		
	}


