<?php
	//セッション開始
	session_start();
	
 require_once("./db_connect.php");
?>

<DOCTYPE html>
<html lang=="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
	</head>
	
	<body>
	<form action="./profile_check.php" method="post" enctype="multipart/form-data">
		<p>名前<input name="name" type="text" value=""></p>
		<p>年齢<input name="age" type="number" value=""></p>
		<p>性別　男性<input name="sex" type="radio" value="1">女性<input name="sex" type="radio" value="2"></p>
		<p>自己紹介</p><textarea name="self"></textarea>
		<p>アイコン<input name="icon" type="file"></p>
		<input type="submit" value="確認画面へ">
	</form>

	</body>
<html>