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
	$thumb = $_SESSION["thumb_path"];

	
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

	$stmt = $dbh->query($sql);
	$stmt->execute();

	//u_info更新
	$sql= "UPDATE u_info SET "
			. "U_AGE = " . $age . ", "
			. "U_SEX = " . $sex . ", "
			. "U_COMMENT = \"" . $self . "\", "
			. "U_THUMB = \"" . $thumb . "\" "
			. "WHERE "
			. "U_ID = " . $u_id;
	
	$stmt = $dbh->query($sql);
	$stmt->execute();

	//コミット
	$dbh->commit();

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
			<p class="align-c">プロフィールの編集が完了しました♪</p>
			<p class="align-c">
				<a href="./member_page.php"><input  type="button" name="tomypage" value=" マイページへ "></a>
			</p>
		</div>
	</article>

<?php
	// 共通フッター要素を読み込み
	require 'footer.php';
?>
