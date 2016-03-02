<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン成功画面</title>
</head>
<body>
<?php
session_start();

if ( isset($_SESSION['loginUser']) ) {
	$name = $_SESSION['loginUser'];
	print "<h1>ログイン成功</h1>";
	print "<p>ログインしているユーザーは <b>".$name."</b> です。</p>";
} else {
	var_dump($_SESSION['loginUser']);
}
?>
</body>
</html>
