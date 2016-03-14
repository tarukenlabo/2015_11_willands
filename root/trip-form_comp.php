<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>投稿完了</title>
	<head>
	<body>
		<?php include_once("analyticstracking.php") ?>
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
				<h2 class="contents-title align-c">投稿記事編集</h2>

				<div class="box shadow">
				
					<div class="align-c">
						
							<p class="other-text align-c"><?php echo "投稿完了しました。"; ?></p>
							<div class="align-c">
								<button onClick="location.href='./member_page.php'" class="button_120 white align-center">マイページヘ</button>
								<button onClick="location.href='./article.php?p_id=<?php echo $post_id; ?>'" class="button_200 white align-center">投稿した記事を見る</button>
							</div>
								
				</div> <!--.box shadow-->
			</artcle>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>
