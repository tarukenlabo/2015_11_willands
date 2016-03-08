<?php
	require_once("./db_connect.php");
	
	function get_cate(){
		$db = new cls_db();
		$dbh = $db->db_connect();
		
		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM cate";
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		$cate = array();
		/*
		foreach($stmt as $post){
			$cate[] = $post;
		}
		*/
		while($post = $stmt->fetch(PDO::FETCH_ASSOC)){
			$cate[] = $post;
		}

		return $cate;
	}
	/*
	echo "<pre>";
	var_dump(get_cate());
	echo "</pre>";
	*/