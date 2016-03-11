<?php
	session_start();
	require_once("./db_connect.php");
	$p_id = $_GET['p_id'];
?>

<DOCTYPE html>
<html lang="ja">
	<head>
		<title>コメントフォーム</title>
	</head>
	<body>
	<p>テキスト</p>
	
	<p>以上の内容でよろしければ</p>
	<p>送信ボタンを押してください</p>
	<form action="./comment-form-mod.php?p_id=<?php echo $p_id; ?>" method="post" enctype="multipart/form-data">
		<textarea name="comment"></textarea>
		<input type="submit" value="送信">
	</form>
	</body>
</html>