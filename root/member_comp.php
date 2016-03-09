<?php
// 登録フォームを経由しているかをチェック
if (!isset($_POST["submit"])) {
?>
<h3>まず、会員情報登録フォームよりEメールとパスワードをご入力下さい。</h3>
<p><a href="./form.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>
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
		echo '<a href="./form.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>';
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
		print '<a href="./form.php"><input type="button" value="会員情報登録フォームに戻る"></a></p>';
		exit;

	} else {

	// 登録するデーターにエラーがない場合、u_authテーブルにデータを追加する。
	// sql文を準備してデータベースにEmailとパスワードの登録を実行
	$sql = "INSERT INTO u_auth (u_email, u_pass) VALUES ('$input_mail','$input_pass')";
	$stmt = $dbh -> prepare( $sql );
	$stmt -> execute();

	// データベースを閉じてトランザクション終わり
	$dbh = null;

	echo "<h1>登録完了しました♪</h1>";

	}
}
?>
