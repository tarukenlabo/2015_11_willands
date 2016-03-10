<?php
	session_start();
	
	//入力フォームからパラメータを取得
	$user_data = $_SESSION["user_data"];

	var_dump($user_data);

	$u_id = $_SESSION["u_id"];
	$name = $user_data["name"];
	$age = $user_data["age"];
	$sex = $user_data["sex"];
	$self = $user_data["self"];
//	$thumb = $user_data["thumb"];

/*
	//アイコン取込処理

	echo "<p>";

	var_dump($_FILES["thumb"]);

	echo "</p>";
	
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
	$image_name = $image_obj -> imageRenameForThumb( $_FILES["thumb"]["name"],$u_id );
*/
	
	//データベース接続設定
	require_once("./db_connect.php");
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

    //トランザクション処理を開始
    $dbh->beginTransaction();

	//u_auth更新
	$sql= "UPDATE u_auth SET "
				. "U_NAME = \"" . $name . "\" "
			. "WHERE "
			. "U_ID = " . $u_id;

	echo $sql;

	$stmt = $dbh->query($sql);
	$stmt->execute();

	//u_info更新
	$sql= "UPDATE u_info SET "
			. "U_AGE = " . $age . ", "
			. "U_SEX = " . $sex . ", "
			. "U_COMMENT = \"" . $self . "\", "
			. "U_THUMB = \"" . $image_name . "\" "
			. "WHERE "
			. "U_ID = " . $u_id;

	echo $sql;
	
	$stmt = $dbh->query($sql);
	$stmt->execute();

	//コミット
	$dbh->commit();


/*
	//TMPファイル移動
	$upload_file_path = $image_obj -> imageMoveForThumb( $_FILES["thumb"]["tmp_name"], $image_name );
	
	$_SESSION['$thumb'] = $upload_file_path;
*/

?>

<DOCTYPE html>
<html lang=="ja">
	<head>
		<meta charset="UTF-8">
			<title></title>
	</head>
	
	<body>
	<p>投稿完了しました♪</p>
	<p>ありがとうございます☆</p>
	<form action="./member_page.php" method="post" enctype="multipart/form-data">
		<input type="submit" value="マイページへ">
	</form>
	</body>
</html>


