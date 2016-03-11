<?php
//セッション作成
session_start();
if(!isset($_POST['login'])) {
  //ログインフォームを表示
  inputForm();
} else {
  //フォームの値を取得
  $formMail = $_POST['formMail'];
  $formPass = $_POST['formPass'];
	
  //Email, Passwordが未入力の場合
  if(($formMail == "") || ($formPass == "")) {
  //エラー関数の呼び出し
  error(1);
  } else { 

  // Email,Passwordの入力がある場合
  // データベースへ接続
  require_once('./db_connect.php');
  $db = new cls_db();
  $dbh = $db->db_connect();

  // u_authテーブルのデータを取得
  $sql = "SELECT * FROM u_auth WHERE U_EMAIL = '".$formMail."'";
  $stmt = $dbh -> prepare ( $sql );
  $stmt -> execute ();

  // フォームから取得したformMailとデータベース内のU_EMAILが一致したらデータベースの値を変数に格納
  while ( $data = $stmt -> fetch ( PDO::FETCH_ASSOC ) ) {
    if($data['U_EMAIL'] == $formMail) {  // フォームから取得したEmailとデータベースのU_EMAILのチェック
      $dbPass = $data['U_PASS'];  // データベースのU_PASSを取得
      $userId = $data['U_ID'];  // データベースのU_IDを取得
      break;
    }
  }

  // MySQLデータベースを閉じる
  $dbh = null;

  // $dbPassという変数に値が格納されていない場合→formMailとデータベースのU_EMAILが不一致
  if(!isset($dbPass)) {
    error(2);
  } else {
  // フォームのパスワードとデータベース内のパスワードが不一致
  if($dbPass != $formPass){
	  error(3);
	} else {
	  // Email,パスワードどちらも一致
	  // セッション変数を作成→セッション変数に $formUserID を登録
	  $_SESSION['loginUser'] = $formMail;
	  $_SESSION['u_id'] = $userId;
	  header("Location:test.php");
	  // header("Location:index.php");
	  }
	}
  }
}
?>
<?php
  //入力画面表示画面	
  function inputForm() {
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>ログインページ</title>
	<head>
	<body>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>

			<article class="clearFix white">
				<h2 class="contents-title">ログイン</h2>

			<div class="box shadow">
				<form action="log-in.php" method="post">
					<p for="name" class="other-text">メールアドレス</p>
					<input type="text" name="formMail" id="mail" class="box-line1_450">
					<br />
					<p for="password" class="other-text">パスワード</p>
					<input type="text" name="formPass" id="pass" class="box-line1_450">
					<br />
					<div class="align-c"><input type="submit" name="login" value="ログイン" class="button_120 white align-center"></div>
				</form>
			</div><!--.box shadow-->
			</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>


<?php
  }
//エラー表示関数
function error($errorType) {
  
  switch($errorType) {
    case 1:
    $errorMsg = "メールアドレスとパスワードを入力してください。";
    break;
    
    case 2:
    $errorMsg = "メールアドレスが違います";
    break;
    
    case 3:
    $errorMsg = "パスワードが違います";
    break;
}
?>
	
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>
<body>
<h2 class="contents-title">エラーページ</h2>
<?php
  print $errorMsg;
?>
</body>
</html> 
<?php
}
?>