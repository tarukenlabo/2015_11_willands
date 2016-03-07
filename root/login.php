<?php
//セッション作成
session_start();
if(!isset($_POST['login'])) {
  //ログインフォームを表示
  inputForm();
} else {
  //フォームの値を取得
  $formName = $_POST['formName'];
  $formPass = $_POST['formPass'];
	
  //ID, PASWORDが未入力の場合
  if(($formName == "") || ($formPass == "")) {
	
  //エラー関数の呼び出し
  error(1);
		
  } else { 
  //ID,PASSWORD 入力アリ	
  //データベースへ接続
  require_once('./db.php');
				
  //memberテーブルのデータを取得
  $query = "select * from u_auth WHERE U_NAME = '".$formName."'";
  $result = mysql_query($query);
  
  
		
		
  //フォームから取得したu_nameとデータベース内のu_nameが一致したらデータベースのPASSWORDを変数に格納		
  while($data = mysql_fetch_array($result)) {
    if($data['U_NAME'] == $formName) {  //フォームから取得したUSERIDとデータベースのUSERIDが一致
      $dbPass = $data['U_PASS'];
      $userId = $data['U_ID'];//userIdを取得
      break;
    }
  }
	
  //MySQLデータベースを閉じる
  mysql_close($conn);
  
  //$dbPasswordという変数に値が格納されていない場合→formUserIdとデータベースのIDが不一致
  if(!isset($dbPass)) {
    error(2);
  } else {
  //formUserIdとデータベースのIDが一致
  //フォームのパスワードとデータベース内のパスワードが不一致
    if($dbPass != $formPass){
	  error(3);
	} else {
	  //ID,パスワードどちらも一致
	  //セッション変数を作成→セッション変数に　$formUserID を登録
	  $_SESSION['loginUser'] = $formName;
	  $_SESSION['u_id'] = $userId;
	  header("Location:test.php");
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
<title>ログイン</title>
</head>
<body>
  <h1>ログインページ</h1>
  <form action="login.php" method="post">
  <label for="name">アカウント</label>：
  <input type="text" name="formName" id="name"/>
  <br />
  <label for="password">パスワード</label>：
  <input type="text" name="formPass" id="pass"/>
  <br />
  <input type="submit" name="login" value="ログイン" />
</form>
</body>
</html>
<?php
}
//エラー表示関数
function error($errorType) {
  
  switch($errorType) {
    case 1:
    $errorMsg = "アカウントとパスワードを入力してください。";
    break;
    
    case 2:
    $errorMsg = "アカウントが違います";
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
<h1>エラーページ</h1>
<?php
  print $errorMsg;
?>
</body>
</html> 
<?php
}
?>