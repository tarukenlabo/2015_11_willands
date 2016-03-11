<?php
	//セッション開始
	session_start();
	
	require_once("./user.php");
	require 'header.php';
	$u_info = search_user_by_uid($_SESSION['u_id']);

	$u_name = $u_info['U_NAME'];
	$u_age = $u_info['U_AGE'];
	$u_sex = $u_info['U_SEX'];
	$u_comment = $u_info['U_COMMENT'];
	$u_thumb = $u_info['U_THUMB'];

	
?>

<DOCTYPE html>
<html lang=="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
	</head>
	
	<body>
	<form action="./profile_mod.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>名前<input name="name" type="text" value=<?php echo $u_name;?>></td>
			</tr>
			<tr>
				<td>年齢<input name="age" type="number" value=<?php echo $u_age;?>></td>
			</tr>
			<tr>
				<td>性別
				男性<input name="sex" type="radio" value="1" <?php if($u_sex == 1){ print "checked";}?>>
				女性<input name="sex" type="radio" value="2" <?php if($u_sex == 2){ print "checked";}?>>
				</td>
			</tr>
			<tr>
				<td>自己紹介<br><textarea name="self"><?php echo $u_comment;?></textarea></td>
			</tr>
			<tr>
				<td>アイコン<input name="thumb" type="file" value="写真選択"></td>
			<tr>
				<td><img src="<?php echo $u_thumb; ?>"></td>
			</tr>
		  <tr>
		  	<td><input type="submit" value="確認画面へ"></td>
		  </tr>
	</form>

	</body>
<html>

<?php
	// 共通のフッター部分の読み込み
	require 'footer.php';
?>