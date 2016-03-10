<?php
	require "db_connect.php";
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh -> query( "SET NAMES utf8" );
	
	$sql = "SELECT * FROM post";
	$stmt = $dbh -> prepare( $sql );
	$stmt -> execute();
	
	var_dump( $stmt );
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<div id="wrap">
			<header>
				<p>(★ヘッダーです)</p>
			</header>

			<nav>
				<ul class="clearFix">
					<li>(★地図で選ぶ)</li>
					<li>(★カテゴリーで選ぶ)</li>
					<li>(★キーワードで選ぶ)</li>
				</ul>
			</nav>
			
			<article>
				<p>(★メインコンテンツです)</p>
			</article>
			
			<footer>
				<p>(★フッターです)</p>
			</footer>
		</div><!--#wrap-->
	</body>	
</html>