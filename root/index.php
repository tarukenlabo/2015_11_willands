<?php
	require "db_connect.php";
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh -> query( "SET NAMES utf8" );
	
	//ピックアップ
	$pu_select_sql = "SELECT P_ID,P_TITLE,P_AWORD,P_EYE FROM post WHERE P_ID = (SELECT P_ID FROM bookmark GROUP BY P_ID HAVING COUNT(P_ID) = (SELECT MAX(cnt) FROM ( SELECT P_ID,COUNT( * ) AS cnt FROM bookmark GROUP BY P_ID ) AS cnt_tb))";
	$pu_stmt = $dbh -> prepare( $pu_select_sql );
	$pu_stmt -> execute();
	//ピックアップ写真
	$pup_select_sql = "SELECT C_PHOTO FROM post_photo WHERE P_ID = (SELECT P_ID FROM bookmark GROUP BY P_ID HAVING COUNT(P_ID) = (SELECT MAX(cnt) FROM ( SELECT P_ID,COUNT( * ) AS cnt FROM bookmark GROUP BY P_ID ) AS cnt_tb)) ORDER BY RAND() LIMIT 4";
	$pup_stmt = $dbh -> prepare( $pup_select_sql );
	$pup_stmt -> execute();
	
	//最新投稿
	$np_select_sql = "SELECT post.P_ID,post.P_TITLE,post.P_EYE,cnt_tb.cnt FROM post LEFT JOIN ( SELECT P_ID, COUNT( P_ID ) AS cnt FROM bookmark GROUP BY P_ID) AS cnt_tb ON post.P_ID = cnt_tb.P_ID ORDER BY post.P_ID DESC";
	$np_stmt = $dbh -> prepare( $np_select_sql );
	$np_stmt -> execute();
	
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style_oocss.css" type="text/css">
		<title>たるナビ -Tabi-Route Navigation-</title>
	</head>
	<body>
		<div id="container">
			<header>
				<div class="header_bar">
				</div>

				
				<div class="search">
					
					<form action="/" name="search" method="get" class="search_form">
					<dl class="search">
					<dt><input type="text" name="search" value="" placeholder="検索" /></dt>
					<dd><button><span></span></button></dd>
					</dl>
					</form>
					
					<img src="./img/sea.jpg">
					<div class="tarunavi_logo">
					<img src="./img/tarunavi_logo.png" >
					</div>
				</div>
				
				
				
				
			</header>

			<nav class="nav_box">
				<ul>
					<li class="l-float margin-none">
						<div class="nav_button">
							<img src="./img/pointer.png" class="margin10">
							<p>地図でさがす</p>
						</div>
					</li>

					<li class="r-float margin-none">
						<div class="nav_button">
							<img src="./img/folder.png" class="margin10">
							<p>カテゴリでさがす</p>
						</div>
					</li>

				</ul>

			</nav>
			
			<article>
<<<<<<< HEAD
				<!-- ピックアップ本文 -->
				<?php while( $result = $pu_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
				<h2><?php echo $result["P_TITLE"]; ?></h2>
				<p><?php echo $result["P_AWORD"]; ?></p>
				<p><img src="<?php echo $result["P_EYE"] ?>" alt="ピックアップ写真"><?php echo $result["P_EYE"] ?></p>
				<p><a href="./article.php?P_ID=<?php echo $result["P_ID"] ?>">アーティクルページへ</a></p>
				<?php endwhile; ?>
				
				<!-- ピックアップ写真 -->
				<?php while( $result = $pup_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
				<p><img src="<?php echo $result["C_PHOTO"] ?>" alt="ピックアップ写真"><?php echo $result["C_PHOTO"] ?></p>
				<?php endwhile; ?>
			</article>
			
			<article>
				<!-- 最新投稿 -->
				<?php while( $result = $np_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
				<h2><?php echo $result["P_TITLE"]; ?></h2>
				<p>ブックマークカウント<?php echo $result["cnt"] ?></p>
				<p><img src="<?php echo $result["P_EYE"] ?>" alt="ピックアップ写真"><?php echo $result["P_EYE"] ?></p>
				<p><a href="./article.php?P_ID=<?php echo $result["P_ID"] ?>">アーティクルページへ</a></p>
				<?php endwhile; ?>
=======
				<p>(★メインコンテンツです)</p>
				<div class="">
					
					
				</div>
>>>>>>> c485497676182962970fe24f7a68e6ac45f261db
			</article>
			
			<footer class="l-float">
				<div class="fotter_logo l-float">
					<img src="./img/tarunavi_logo_footer.png" >
				</div>
				
					<ul class="l-float footer_nav">
						<li><a href="#">たるナビトップ</a></li>
						<li><a href="#">ログイン</a></li>
						<li><a href="#">会員登録</a></li>
						<li><a href="#">利用規約</a></li>
						<li><a href="#">プライバシーポリシー</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">お問い合わせ</a></li>
					</ul>
				
			</footer>
		</div>
	</body>	
</html>