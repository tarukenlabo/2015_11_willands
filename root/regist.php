<?php
	require_once( "./Search.php" );	
	var_dump( $_POST );

	
	//カテゴリサーチ
	$searcObj = new Search( $_POST );
	
	echo "<pre>";
	var_dump( $searcObj -> searchText["search_text"] );
	echo "</pre>";
