<?php
	require "db_connect.php";
	require "category.php";
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
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/navi.js"></script>
		<title>たるナビ -Tabi-Route Navigation-</title>
	</head>
	<body>
		<div id="container" class="align-center orange">
			<header>
				<div class="header_bar">
				</div>

				
				<div class="search">
					
					<form action="./result.php" name="search" method="get" class="search_form">
					<dl class="search">
					<dt><input type="text" name="search_word" value="" placeholder="検索" /></dt>
					<dd><button><span></span></button></dd>
					</dl>
					</form>
					
					<img src="./img/sea.jpg">
					<div class="tarunavi_logo">
					<img src="./img/tarunavi_logo.png" >
					</div>
				</div>
				
				
				
				
			</header>

			<nav>
				<ul>
					
					<li class="l-float margin-none nav_button">
							<img src="./img/pointer.png" class="margin10 ">
							<p class="article-title bold margin-none">地図でさがす</p>
					</li>
					

					<li class="r-float margin-none nav_button cate_navi_button">
							<img src="./img/folder.png" class="margin10">
							<p class="article-title bold margin-none">カテゴリでさがす</p>
					</li>

				</ul>

			</nav>
			<div id="cate_navi">
				<ul>
					<?php get_cate(); ?>
				</ul>
			</div>
			