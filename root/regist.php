<?php
/* 入力フォームからパラメータを取得 */
$formList = array('mode', 'input_name', 'input_mail', 'input_pass');

/* ポストデータを取得しパラメータと同名の変数に格納 */
foreach($formList as $value) {
  $$value = $_POST[$value];
}

/* データベース接続設定 */
require_once('db.php');

  //登録するデーターにエラーがない場合、usersテーブルにデータを追加する。
  //トランザクション開始
  mysql_query("begin");
  
  $query = "insert into u_auth (u_name, u_email, u_pass) values('$input_name','$input_mail','$input_pass')";
  $result = mysql_query($query);
  
if ($result) {  //登録完了	
  //トランザクション終わり
  mysql_query("commit");
}
?>

<h1>登録完了</h1>

