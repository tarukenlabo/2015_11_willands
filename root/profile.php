<?php
	//セッション開始
	session_start();
	
	require_once("./user.php");

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
		<p>名前<input name="name" type="text" value=<?php echo $u_name;?>></p>
		<p>年齢<input name="age" type="number" value=<?php echo $u_age;?>></p>
		<p>性別
				男性<input name="sex" type="radio" value="1" <?php if($u_sex == 1){ print "checked";}?>>
				女性<input name="sex" type="radio" value="2" <?php if($u_sex == 2){ print "checked";}?>>
		</p>
		<p>自己紹介</p><textarea name="self"><?php echo $u_comment;?></textarea>
		<p>アイコン<input name="icon" type="file"></p>
		<input type="submit" value="確認画面へ">
	</form>

	</body>
<html>