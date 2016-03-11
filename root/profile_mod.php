<?php
	require_once("./db_connect.php");
	require "ErrorHandling.php";
	require "ImageObj.php";

	//セッション開始
	session_start();

	//初期処理
	$error = new ErrorHandling;
	$image_obj = new ImageObj;
	$e_message = 0;

	
	$_SESSION["user_data"] = $_POST;

	$name = $_POST["name"];
	$age = $_POST["age"];
	$sex = $_POST["sex"];
	$self = $_POST["self"];
	$thumb = ( $_FILES["thumb"] );

	/////////////////
	//アイコン取込処理
	/////////////////
	
	//ファイルサイズ判定
	if( $error -> fileSizeDecision( (int)$_FILES["thumb"]["size"] ) ){
		$e_message[] = "アップロードできるファイルサイズの上限20Mを超えています。";
	}
	
	//ファイル拡張子判定
	if( $error -> fileExtendDecision( (int)$_FILES["thumb"]["name"] ) ){
		$e_message[] = "アップロードできるファイルの種類は画像のみです。";
	}
	
	//一つでもエラーがあればリダイレクト
	if( is_array( $e_message ) ){
		header( "Location: ./chek-in_map.php" );
	}
	
	//アップロード画像リネーム
	$image_name = $image_obj -> imageRenameForThumb( $_FILES["thumb"]["name"],$_SESSION["u_id"] );

	//TMPファイル移動
	$upload_file_path = $image_obj -> imageMoveForThumb( $_FILES["thumb"]["tmp_name"], $image_name );
	
	$_SESSION['thumb_path'] = $upload_file_path;

?>

<DOCTYPE html>
<html lang=="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
	</head>
	
	<body>
	<form action="./profile_comp.php" method="post" enctype="multipart/form-data">
		<p>名前　<?php echo $name; ?></p>
		<p>年齢　<?php echo $age; ?></p>
		<p>性別　<?php 
					if($sex == 1){
						echo '男性';
					}else{
						echo '女性';
					} ?></p>
		<p>自己紹介 <?php echo $self; ?></p>
		<p>アイコン<?php echo $thumb["name"]; ?></p>
		<input type="submit" value="これで登録"> 
	</form>

	</body>
<html>