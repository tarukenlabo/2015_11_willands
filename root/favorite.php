<?php
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	session_start();
	$u_id = 18;
	
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$get_bkm = "SELECT * FROM bookmark WHERE U_ID = ".$u_id;
	$bkm = $dbh->prepare($get_bkm);
	$bkm->execute();
	
	$p_id = array();
	foreach($bkm as $num){
		$p_id[] = $num['P_ID'];
	}
	
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>お気に入り記事一覧</title> 
	<head>
	<body>
		<?php include_once("analyticstracking.php") ?>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

/*			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>
*/
			<article class="clearFix white">			
				<h2 class="contents-title align-c">お気に入り記事一覧</h2>
	
	
	<?php foreach($p_id as $n):
	
		$sql = "SELECT P_ID,P_TITLE,P_EYE FROM post WHERE P_ID =".$n;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		foreach($stmt as $result):?>
			<div class="bkm_posts box-4 white l-float">
				<a href="article.php?P_ID=<?php echo $result['P_ID']; ?>"><img class="photo4 white" src="<?php echo $result['P_EYE']; ?>" >
				<h3 class ="sub-article-title align-c"><?php echo $result["P_TITLE"]; ?></h3></a><br>
				<button class="button_120 white align-center" onClick="location.href='./bkm_delete.php?p_id=<?php echo $n; ?>'">ブックマーク解除</button>
			</div>
	<?php endforeach;
	endforeach; ?>

			</article>

			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>
