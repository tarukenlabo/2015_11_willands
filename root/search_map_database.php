<?php

	require_once("./db_connect.php");
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh->query('SET NAMES utf8');
	
	
	//緯度・経度保存変数
	$ido = 44.381911;
	$keido = 126.133374;
	
	
	$url = "http://maps.google.com/maps/api/geocode/json?latlng=".$ido.",".$keido."&sensor=false";
	$req = file_get_contents($url);
	$arr = json_decode($req,true);
	
	/*
	echo '<pre>';
	var_dump($arr);
	echo '</pre>';
	*/
	
	//echo "<h1>".$arr['results'][2]['formatted_address']."</h1>";
	
	//配列に保存
	$post=split(",",$arr['results'][2]['formatted_address']);
	//$post=split(",",$arr['results'][0]['formatted_address']);

	//配列数取得
	$length = count($post);
	$country = $post[$length - 1];

	$jp = ' Japan';

	//県のデータ保存
	

	if($country === $jp){
		$pref = $post[$length - 2];
		echo '<h1>国：日本</h1>';
		$pref = preg_replace("/\d+/","",$pref);
		$pref = preg_replace("/-/","",$pref);
		echo "<h1>県：".$pref."</h1>";
	}else{
		echo '<h1>国：'.$country.'</h1>';
	}
	
	
	if($country === $jp){
		$sql = "SELECT ID FROM map_master WHERE LOCATION ='".$pref."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		
		foreach($stmt as $post){
			$pref_id = $post['ID'];
		}
		echo $pref_id;
	}else{
		$sql = "SELECT ID FROM map_master WHERE LOCATION = ".$country;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		foreach($stmt as $post){
			$pref_id = $post['ID'];
		}
		
		$sql_country_insert = "INSERT INTO post_check_in(M_ID) VALUES($country_id)";
	}
