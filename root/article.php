<?php
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	$p_id = $_GET['P_ID'];
	//しおり内容取得
	$get_post = "SELECT * FROM post WHERE P_ID = ".$p_id;
	$stmt = $dbh->prepare($get_post);
	$stmt->execute();
	
	//ログインしてるか判断
 	session_start();
 	if(isset($_SESSION['u_id'])){
 		$u_id = $_SESSION['u_id'];
 	}
	
	//しおり内容を変数に格納
	foreach($stmt as $post){
		$title = $post['P_TITLE'];
		$img_src = $post['P_EYE'];
		$peaple = $post['P_PEAPLE'];
		$price = $post['P_PRICE'];
		$sday = $post['P_SDAY'];
		$fday = $post['P_FDAY'];
		$p_cate = $post['P_CAT'];
		$p_comment = $post['P_AWORD'];
		$u_id = $post['U_ID'];
	}
	
	//ユーザーネーム取得
	$get_u_name = "SELECT U_NAME FROM u_auth WHERE U_ID =".$u_id;
	$uName = $dbh->prepare($get_u_name);
	$uName->execute();
	
	foreach($uName as $name){
		$userName = $name['U_NAME'];
	}
	
	//カテゴリ名取得
	$get_cate = "SELECT CATE_NAME FROM cate WHERE CATE_ID =".$p_cate;
	$getCate = $dbh->prepare($get_cate);
	$getCate->execute();
	
	foreach($getCate as $cname){
		$cateName = $cname['CATE_NAME'];
	}
	
	//都度投稿取得
	$get_checkin = "SELECT * FROM post_check_in WHERE P_ID =".$p_id."&& U_ID = ".$u_id;
	$get_checks = $dbh->prepare($get_checkin);
	$get_checks->execute();
	

	//位置情報取得
	$get_posts_map = "SELECT C_TITLE,C_POSIX,C_POSIY FROM post_check_in WHERE P_ID = '".$p_id."'";
	$posts_map = $dbh->prepare($get_posts_map);
	$posts_map->execute();

	$args = array();
	
	while($test = $posts_map->fetch(PDO::FETCH_ASSOC) ){
		$args[] = $test;
	}

	$count = count($args);

	
	if($count === 0){
		$posix = 35.67849;
		$posiy = 139.39178;
	}else{
		$posix = $args[0]['C_POSIX'];
		$posiy = $args[0]['C_POSIY'];		
	}

	//コメント取得
	$get_comment = "SELECT u_auth.U_NAME,user_post_comment.P_ID,user_post_comment.UP_COMMENT FROM user_post_comment JOIN u_auth ON user_post_comment.U_ID = u_auth.U_ID WHERE P_ID =".$p_id;
	$gcome = $dbh->prepare($get_comment);
	$gcome->execute();

?>

<?php require 'header_map.php' ; ?>

	<body>
		<?php include_once("analyticstracking.php") ?>
	
	<article class="hadairo">

	<div class="wrap">

		<div class="align-c">
		
			<h2><?php echo $title; ?></h2>
			
			<?php if(isset($_SESSION['u_id'])): ?>
				<button class="bkm" onClick="location.href='./bkm.php?p_id=<?php echo $p_id; ?>'">お気に入り</button>
			<?php endif; ?>

		
		</div>
		
		<div class="title_box align-center">
			<div class="l-float show_img">
			<img class="main_article_image" src="<?php echo $img_src; ?>">
			</div>
			<table class="r-float">
				<tr>
					<th>投稿者名</th>
					<td><?php echo $userName; ?></td>
				</tr>
				
				<tr>
					<th>投稿テーマ</th>
					<td><?php echo $cateName; ?></td>
				</tr>
				
				<tr>
					<th>人数</th>
					<td><?php echo $peaple; ?>人</td>
				</tr>
				
				<tr>
					<th>金額</th>
					<td><?php echo $price; ?>円</td>
				</tr>

				<tr>
					<th>日数</th>
					<td><?php echo $sday; ?>～<?php echo $fday; ?></td>
				</tr>
			</table>
		</div>
		
		
		
	
		
		
		<div class="check">
			<?php foreach($get_checks as $check): ?>
				<div class="box-frame shadow checkins clearFix" style="border: 2px solid orange">
					<h3><?php echo $check['C_TITLE']; ?></h3>
					<div class="check_comment">
						<?php echo $check["C_COMMENT"]; ?>
					</div>
					<div class="check_img">
						<?php
							//都度投稿写真取得
							$get_posts_photo = "SELECT * FROM post_photo WHERE C_ID = '".$check['C_ID']."' && P_ID = '".$p_id."'";
							$post_photo = $dbh->prepare($get_posts_photo );
							$post_photo->execute();
						
						foreach($post_photo as $val): ?>
							<img class="r-float sub_article_image" src="<?php echo $val["C_PHOTO"]; ?>">
						<?php endforeach; ?>
					</div>

				</div>
			<?php endforeach; ?>
		</div>
		<div  id="map_canvas" style="width:70%;height:600px;margin:0 auto;"></div>
		
	
	<div class="comment_box box-frame align-center">
		<div class="contributor_comment box-frame" style="border: 2px solid orange">
			<h2>投稿者コメント</h2>
			<p><?php echo $p_comment; ?></p>
		</div>
	<div class="comments viewers_comment box-frame" style="border: 2px solid orange">
			<h2>閲覧者のコメント</h2>
			<?php if(empty($gcome)):?>
				<p>コメントがありません</p>
				<?php else: ?>
				<?php foreach($gcome as $come): ?>
					<div class="come" style="margin:0 auto;">
						<table>
							<tr>
								<th><?php echo $come["U_NAME"]; ?></th>
								<td><?php echo $come["UP_COMMENT"]; ?></td>
							</tr>
						</table>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>
			
		</div>
		
		<?php if(isset($_SESSION['u_id'])): ?>
			<a href="./comment-form.php?p_id=<?php echo $p_id; ?>"><p>コメントを投稿する</p></a>
		<?php endif; ?>

	</article>

	
		<?php require 'footer.php' ; ?>

	</div>
	</body>	
</html>