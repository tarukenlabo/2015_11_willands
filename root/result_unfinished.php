<?php
	require_once("./db_connect.php");
	
	//インデックスからのデータ　デフォルトセット
	$map = "地域名";
	$category = "カテゴリ";
	$search_word = "検索ワード";
	
	if( isset($_GET["map"]) )
		$map = $_GET["map"];
	
	if( isset($_GET["cate"]) )
		$category = $_GET["cate"];

	if( isset($_GET["search_word"]) )
		$search_word = $_GET["search_word"];
		
	//データベース接続
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh -> query( "SET NAMES utf8" );
	
	//カテゴリ取得SQL
	$cat_sql = "SELECT * FROM cate";
	$stmt = $dbh -> prepare( $cat_sql );
	$stmt -> execute(); 
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
		<script src="./js/result.js" type="text/javascript"></script>
		
		<title>検索結果</title>
	</head>
	
	<body>
		<h1>トップページから結果表示</h1>
		<form>
			<ul>
				<li><input type="text" value="<?php echo $map; ?>"></li>
				<li><input id="cate-box" name="cate_text" type="text" value="<?php echo $category; ?>"></li>
				<li><input type="text" value="<?php echo $search_word; ?>"><button>検索</button></li>
			</ul>
		</form>
		<ul>
			<?php while( $result = $stmt -> fetch( PDO::FETCH_ASSOC ) ): ?>
			<li><a class="cate-link" href="cat_<?php echo $result["CATE_ID"] ?>"><?php echo $result["CATE_NAME"] ?></a></li>
			<?php endwhile; ?>
		</ul>
		<div class="ex"></div>
		<!-- 以下、地図領域 -->
		<?php if( !isset( $_GET["map"] ) ): ?>
		<div>
			<h2>地図領域</h2>
		</div>
		<?php endif; ?>
	</body>
</html>