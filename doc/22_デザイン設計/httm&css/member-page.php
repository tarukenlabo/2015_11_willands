<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./style.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
			<article class="hadairo">
				<div class="large-photo l-float white"></div>
					<div class="r-float align-r margin30">
						<h2 class="my-page">〇〇さんのマイページ</h2>
						<button type="button" onclick="location.href=''"  class="white box-line1"><a class=" clear-text" href=""><p class="other-title bold">プロフィールを編集</p></a></button><br>
						<button type="button" onclick="location.href=''"  class="white box-line1"><a class=" clear-text" href=""><p class="other-title bold">お気に入りの記事へ</p></a></button>
					</div>
				
				<div class="box-frame shadow align-center white clearFix">
					<p class="article-title l-float">旅行記一覧</p>
					<button type="button" onclick="location.href=''"  class="box-line1 r-float"><a class=" clear-text" href=""><p class="other-title bold">新しい旅行記を作成</p></a></button>
					<div class="trip-frame-box l-float shadow clearFix">
						<a href="">
						<div class="trip-frame-photo l-float">
						</div>
						<div class="margin10 l-float">
							<h3 class="other-text">○○年○月○日～○○年○月○日</h3>
							<h3 class="other-text">タイトルタイトルタイトル</h3>
						</div>
						<div class="r-float align-c margin10">
							<p class="">公開ステータス</p>
							<p class="other-text">公開</p>
						</div>
						</a>
					</div>
					
					<button type="button" onclick="location.href=''"  class="check-in l-float other-text shadow"><a class="clear-text" href="">チェックイン</a></div>
				
				
				
				</div>
			</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>