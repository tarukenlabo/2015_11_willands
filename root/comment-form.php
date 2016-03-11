<?php
	session_start();
	require_once("./db_connect.php");
	$p_id = $_GET['p_id'];
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/sato-style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>コメントページ</title>
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
				<h2 class="contents-title align-c">コメント</h2>

				<div class="box shadow">
				
					<div class="align-c">
						<form action="./comment-form-mod.php?p_id=<?php echo $p_id; ?>" method="post" enctype="multipart/form-data">
							<textarea name="comment" class="box-line4"></textarea>
							<p class="other-text align-c">以上の内容でよろしければ送信ボタンを押してください</p>
							<div class="align-c"><input type="submit" value="送 信" class="button_120 white align-center"></div>
						</form>
				</div> <!--.box shadow-->
			</artcle>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>
