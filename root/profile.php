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

<?php
	// 共通のヘッダー部分の読み込み
	require 'header.php';
?>
<!-- // navigation部分になる予定
			<nav>
			</nav>
-->

	<article class="hadairo">
		<div class="form_box">
			<h1 class="align-c">プロフィール</h1>
			<form action="./profile_mod.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
					    <th class="">名前</th>
					    <td><input class="box-line1" name="name" type="text" size="30"value=<?php echo $u_name;?> required></td>
					</tr>
					<tr>
					    <th class="">年齢</th>
					    <td><input class="box-line1" name="age" type="number" value=<?php echo $u_age;?> required></td>
					</tr>
					<tr>
						<th class="">性別</th>
						<td>
							男性<input name="sex" type="radio" value="1" <?php if($u_sex == 1){ print "checked";}?>>
							女性<input name="sex" type="radio" value="2" <?php if($u_sex == 2){ print "checked";}?>>
						</td>
					</tr>
					<tr>
						<th class="">自己紹介</th>
						<td><textarea class="box-line1" name="self" size="30"><?php echo $u_comment;?></textarea></td>
					</tr>
					<tr>
						<th class="">アイコン</th>
						<td><input name="thumb" type="file" value="写真選択"><br>
							<img src="<?php echo $u_thumb; ?>"></td>
					</tr>
				</table>
				<input class="check_button"  type="submit" value="確認画面へ">
			</form>
		</div>
	</article>

<?php
	// 共通のフッター部分の読み込み
	require 'footer.php';
?>
