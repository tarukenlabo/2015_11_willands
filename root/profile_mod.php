<?php
	require_once("./db_connect.php");

	//セッション開始
	session_start();
	
	$name = $_POST["name"];
	$age = $_POST["age"];
	$sex = $_POST["sex"];
	$self = $_POST["self"];
	$icon = ( $_FILES["icon"] );
	var_dump($_POST);
	echo "<br>";
	var_dump(icon);

?>

<DOCTYPE html>
<html lang=="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
	</head>
	
	<body>
	<form action="./profile_regist.php" method="post" enctype="multipart/form-data">
		<p>名前　<input type="text" name="name" value="<?php echo $name; ?>"></p>
		<p>年齢　<?php echo $age; ?></p>
		<p>性別　<?php 
					if($sex == 1){
						echo '男性';
					}else{
						echo '女性';
					} ?></p>
		<p>自己紹介 <?php echo $self; ?></p>
		<p>アイコン<?php echo $icon; ?></p>
		<p><input type="button" value="編集に戻る" onclick="./profile.php"> 
		 <input type="submit" value="これで登録"> 
	</form>

	</body>
<html>