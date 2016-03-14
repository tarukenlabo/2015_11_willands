<?php
	require_once( "./Search.php" );	
	var_dump( $_POST );

	
	//カテゴリサーチ
	$searchObj = new Search( $_POST );
	$sql = $searchObj -> changeSql();
	$stmt = $searchObj -> selectSql( $sql );
	
	echo "<pre>";
	var_dump( $stmt );
	echo "</pre>";
	
	$result = $stmt -> fetch( PDO::FETCH_ASSOC );
	
	echo "<pre>";
	var_dump( $result );
	echo "</pre>";
	