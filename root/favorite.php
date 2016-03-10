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
	<link rel="stylesheet" href="./css/post_style.css">
</head>
<body>
	<h1>お気に入り記事一覧</h1>
	
	
	<?php foreach($p_id as $n):
	
		$sql = "SELECT P_ID,P_TITLE,P_EYE FROM post WHERE P_ID =".$n;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		foreach($stmt as $result):?>
			<div class="bkm_posts">
				<a href="article.php?P_ID=<?php echo $result['P_ID']; ?>"><img src="<?php echo $result['P_EYE']; ?>">
				<h3><?php echo $result["P_TITLE"]; ?></h3></a>
			</div>
		<?php endforeach;
	 endforeach; ?>
</body>
</html>