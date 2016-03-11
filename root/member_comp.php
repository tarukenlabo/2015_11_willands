<?php
session_start();

// 登録フォームを経由しているかをチェック
if (!isset($_POST["submit"])) {
?>
<h3>まず、会員情報登録フォームよりEメールとパスワードをご入力下さい。</h3>
<p><a href="./new-member.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>
<?php
} else {
	// 入力フォームからパラメータを取得 
	$formList = array('mode', 'input_mail', 'input_pass', 'pass_conf');

	// 取得したポストデータをパラメータと同名の変数に格納
	foreach($formList as $value) {
	  $$value = $_POST[$value];
	}

	// 入力されたパスワードの確認
	if ( $input_pass !== $pass_conf ) {
		echo '<h3 style="color: red;">エラー</h3>';
		echo '<p>ご入力いただいたパスワードに誤りがあります<br>';
		echo '<a href="./new-member.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>';
		exit;
	}

	// データベース接続設定
	require_once('db_connect.php');

	// データベース接続確立
	$db = new cls_db();
	$dbh = $db->db_connect();

	$dbh -> query( 'SET NAMES utf8' );

	// POSTされたEmailがすでに登録済みでないか確認
	$chk_email = "SELECT u_id FROM u_auth WHERE u_email = '$input_mail'";
	$stmt = $dbh -> prepare ( $chk_email );
	$stmt -> execute ();

	// Emailが登録済みの場合のエラー処理
	$error_id = $stmt -> fetch(PDO::FETCH_ASSOC);
	if ( $error_id['u_id'] > 0) {
//		var_dump( $error_id );
		print '<h3 style="color: red;">エラー</h3>';
		print '<p>ご入力いただいたＥメールアドレスはすでに登録済みです<br>';
		print '<a href="./new-member.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>';
		exit;

	} else {

	// 登録するデータにエラーがない場合、u_authテーブルにデータを追加する。
	// sql文を準備してデータベースにEmailとパスワードの登録を実行
	$sql = "INSERT INTO u_auth (U_EMAIL, U_PASS) VALUES ('$input_mail','$input_pass')";
	$stmt = $dbh -> prepare( $sql );
	$stmt -> execute();

	// 登録されたデータからU_IDを参照して、u_infoテーブルにデータを追加する。
	// データベースにEmailと合致するU_IDを問い合わせる
	$getUid = "SELECT U_ID from u_auth WHERE U_EMAIL = '$input_mail'";
	$stmt = $dbh -> prepare( $getUid );
	$stmt -> execute();
	// 返り値を配列に格納
	$Uid = $stmt -> fetch(PDO::FETCH_ASSOC);
	
	// SESSION変数にU_IDを引き渡しておく
	$_SESSION['u_id'] = $Uid['U_ID'];

	// u_infoテーブルにU_IDを新規登録
	$putUid = "INSERT INTO u_info (U_ID) VALUES ($Uid[U_ID])";
	$stmt = $dbh -> prepare( $putUid );
	$stmt -> execute();

	// データベースを閉じてトランザクション終わり
	$dbh = null;

	echo "<h1>登録完了しました♪</h1>";
	echo '<p><a href="./member_page.php"><input type="button" value="マイページへ"></a><a href="./index.php"><input type="button" value="投稿記事を見る"></a></p>';

	}
}
?>
