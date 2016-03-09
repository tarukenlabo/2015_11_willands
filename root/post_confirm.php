<?php
	session_start();
	
	$_SESSION["post_data"] = $_POST;
	
	$u_id = 1;
	$post_id = 2;

	
	
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$stmt=$dbh->prepare("SELECT CATE_NAME FROM cate WHERE CATE_ID = '".$_POST['cate']."'");
	$stmt->execute();
	
	foreach($stmt as $val){
		$cate_name = $val['CATE_NAME'];
	}
	
	
	$get_posts = "SELECT * FROM post_check_in WHERE P_ID = '".$post_id."'";
	$posts = $dbh->prepare($get_posts);
	$posts->execute();

	
?>

<!DOCTYPE html>
<head>
</head>
<body>
	<div id="wrap">
		<table>
			<tr>
				<th>タイトル</th>
				<td><?php echo $_POST['title']; ?></td>
			</tr>
			
			<tr>
				<th>投稿テーマ</th>
				<td><?php echo $cate_name; ?></td>
			</tr>
			
			<tr>
				<th>人数</th>
				<td><?php echo $_POST["peaple"]; ?>人</td>
			</tr>
			
			<tr>
				<th>金額</th>
				<td>￥<?php echo $_POST['price']; ?></td>
			</tr>
			
			<tr>
				<th>日数</th>
				<td><?php echo $_POST['sday']; ?>&nbsp～&nbsp<?php echo $_POST['fday']; ?></td>
			</tr>
			
			<tr>
				<th>記事全体コメント</th>
				<td><?php echo $_POST['comment']; ?></td>
			</tr>
		</table>	
			
			
			<div id="checkins">
				<?php foreach($posts as $checks):
					$c_id = $checks['C_ID'];
					$p_id = $checks['P_ID'];
				 ?>
						<div class="check_comment" id="<?php echo $c_id; ?>" style="border:1px solid black">
							<h3><?php echo $checks['C_TITLE']; ?></h3>
							<p><?php echo $checks['C_COMMENT']; ?></p>
													
													
							<?php
								$get_posts_photo = "SELECT * FROM post_photo WHERE C_ID = '".$c_id."' && P_ID = '".$p_id."'";
								$posts = $dbh->prepare($get_posts_photo );
								$posts->execute();
								
								foreach($posts as $photo): ?>
									<div class="photo"><img src="<?php echo $photo['C_PHOTO']; ?>"></div>
								<?php endforeach; ?>
						</div>
				<?php endforeach; ?>
			</div>


		<button onClick="history.back()">戻る</button>
		<button onClick="location.href='./post_rough.php'">下書きを保存（非公開）</button>
		<button onClick="location.href='./post_release.php'">公開</button>
	</div>
</body>
</html>
