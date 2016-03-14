<?php
	require "db_connect.php";
	require "ErrorHandling.php";
	require "ImageObj.php";
	
	session_start();
	
	$user_id = $_SESSION["u_id"];
	$post_id = $_POST["p_id"];
	
	$error = new ErrorHandling;
	$image_obj = new ImageObj;
	$e_message = 0;
	
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
	
	//アップロード画像リネーム
	$image_name = $image_obj -> imageRename( $_FILES["uPhoto"]["name"],$user_id,$post_id );
	//TMPファイル移動
	$upload_file_path = $image_obj -> imageMove( $_FILES["uPhoto"]["tmp_name"], $image_name );
	
	$url = "http://maps.google.com/maps/api/geocode/json?latlng=".$_POST["uLat"].",".$_POST["uLng"]."&sensor=false";
	$req = file_get_contents($url);
	$arr = json_decode($req,true);
	
	
	//配列に保存
	$post=split(",",$arr['results'][2]['formatted_address']);
	
	//配列数取得
	$length = count($post);
	$country = $post[$length - 1];

	$jp = ' Japan';
	
	//データベース接続確立
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh -> query( 'SET NAMES utf8' );


	//県のデータ保存
	if($country === $jp){
		$pref = $post[$length - 2];
		$pref = preg_replace("/\d+/","",$pref);
		$pref = preg_replace("/-/","",$pref);
	}
	
	//マップID取得SQL
	if($country === $jp){
		$map_id_sql = "SELECT ID FROM map_master WHERE LOCATION ='".$pref."'";
		
	}else{
		$map_id_sql = "SELECT ID FROM map_master WHERE LOCATION = '".$country."'";
	}
	
	echo $map_id_sql;
	
	$stmt = $dbh -> prepare( $map_id_sql );
	$stmt -> execute();
	
	$map_id = $stmt -> fetch(PDO::FETCH_ASSOC);
	if( !$map_id ){
		$map_id["ID"] = 0;
	}
	
	//post_check_inへの登録
	$insert_sql = "INSERT INTO post_check_in(P_ID,U_ID,C_TITLE,C_POSIX,C_POSIY,C_DATE,C_COMMENT,M_ID) VALUES( ".$post_id.",".$user_id.",'".$_POST["uTitle"]."',".$_POST["uLat"].",".$_POST["uLng"].",now(),'".$_POST["comment"]."',".$map_id["ID"]." )";
	$stmt = $dbh->prepare($insert_sql);
	$stmt->execute();
	
	echo $insert_sql;
	
	//post_photonへの登録
	//チェックインIDの取得
	$select_sql = "SELECT C_ID FROM post_check_in WHERE P_ID = ".$post_id." AND U_ID = ".$user_id;
	$stmt = $dbh->prepare($select_sql);
	$stmt->execute();
	
	echo $select_sql;
	//チェックインIDの配列作成
	while( $result = $stmt -> fetch( PDO::FETCH_NUM ) ){
		foreach( $result as $val ){
			$C_ID_array[] = $val;
		}
	}
	
	
	//チェックインIDの最大値取得
	$key_max = max( array_keys($C_ID_array) );
	
	//post_photoへの登録
	$insert_sql = "INSERT INTO post_photo(C_ID,P_ID,C_PHOTO) VALUES(".$C_ID_array[$key_max].",".$post_id.",'".$upload_file_path."')";
	$stmt = $dbh->prepare($insert_sql);
	$stmt->execute();

	//操作終了後メンバーページへ
	header( 'Location: ./member_page.php' );