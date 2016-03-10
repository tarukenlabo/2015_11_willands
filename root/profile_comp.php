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
//	$icon = $user_data["icon"];
	
	//データベース接続設定
	require_once("./db_connect.php");
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');


	$sql= "UPDATE u_info SET "
				. "U_AGE = " . $age . ", "
				. "U_SEX = " . $sex . ", "
				. "U_COMMENT = \"" . $self . "\" "
//			. "U_THUMB = \"" . $icon . "\", "
			. "WHERE "
			. "U_ID = " . $u_id;

	echo $sql;
	
	$stmt = $dbh->query($sql);
	$stmt->execute();
	
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


