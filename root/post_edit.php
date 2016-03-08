<?php
	require_once("./db_connect.php");
	
	require_once('./get_cate.php');
	$cate = array();
	$cate = get_cate();

	
	//session_start();
	$u_id = 1;
	$post_id = 2;
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh->query('SET NAMES utf8');
	
	$get_posts = "SELECT * FROM post WHERE P_ID = '".$post_id."'";
	
	$stmt = $dbh->prepare($get_posts);
	$stmt->execute();
	
	foreach($stmt as $post){
		$title = $post['P_TITLE'];
		$img_src = $post['P_EYE'];
		$peaple = $post['P_PEAPLE'];
		$price = $post['P_PRICE'];
		$sday = $post['P_SDAY'];
		$fday = $post['P_FDAY'];
		$p_cate = $post['P_CAT'];
		$o_flg = $post['P_OFLAG'];
	}
	
	$get_u_info = "SELECT * FROM u_auth WHERE U_ID = '".$u_id."'";
	$stmt = $dbh->prepare($get_u_info);
	$stmt->execute();
	
	foreach($stmt as $u_info){
		$u_name = $u_info['U_NAME'];
	}
		
		
	$get_posts = "SELECT * FROM post_check_in WHERE P_ID = '".$post_id."'";
	$posts = $dbh->prepare($get_posts);
	$posts->execute();
	/*
	foreach($stmt as $posts){
		$c_comment = $posts['C_COMMENT'];
	}*/


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/post_style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="./js/edit_post.js"></script>
</head>
<body>
	<div id="wrap">
		<div class="title">
		<form action="./post_confirm.php" method="post">
			<p>投稿タイトルを入力</p>
			<input type="text" name="title" value="<?php echo $title; ?>">
		</div>
		
		<div class="post_detail">
			<div class="post_img">
				<img src="<?php echo $img_src; ?>">
			</div>
			
			<div class="post_detail2">
				<table>
					<tr>
						<th>投稿者名</th>
						<td><?php echo $u_name; ?></td>
					</tr>
		
					<tr>
						<th>投稿テーマ</th>
						<td>
							<select name="cate">
								<?php foreach($cate as $val): 
									$cate_id = $val['CATE_ID'];
								?>
									<option value="<?php echo $cate_id; ?>" <?php if($cate_id === $p_cate){echo 'selected';} ?>><?php echo $val['CATE_NAME'];?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					
					<tr>
						<th>人数</th>
						<td><input type="number" name="peaple" value="<?php echo $peaple; ?>"></td>
					</tr>
					
					<tr>
						<th>金額</th>
						<td><input type="number" name="price" value="<?php echo $price; ?>"></td>
					</tr>
					
					<tr>
						<th>日数</th>
						<td><input type="date" name="sday" value="<?php echo $sday; ?>">&nbsp～&nbsp<input type="date" name="fday" value="<?php echo $fday; ?>"></td>
					</tr>
					
				</table>
			</div>
		
			
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
						<button id="<?php echo $c_id; ?>" class="edit_button">編集</button>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		<input type="submit" value="確認画面へ">
		</form>
	</div>
</body>
</html>