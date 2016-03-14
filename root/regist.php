<?php
	require_once( "./Search.php" );	
	var_dump( $_POST );

	
	//カテゴリサーチ
	$searchObj = new Search( $_POST );
	$key_array = $searchObj -> getKeyArray();
	
	echo "<pre>";
	
	var_dump( $searchObj -> searchRun( $key_array ) );
	
	echo "</pre>";
	
	$stmt = $searchObj -> searchRun( $key_array );
	foreach( $stmt as $val ){
		echo "<pre>";
		var_dump( $val );
		echo "</pre>";
	}
