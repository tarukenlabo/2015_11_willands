<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./style.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<?php include_once("analyticstracking.php") ?>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
<article class="hadairo">

	<div id="wrap">
		<div class="contents-title align-c ">
		
		<form action="./post_confirm.php" method="post">
			<p class="article-title">投稿タイトルを入力</p>
			<input class="box-line2 " type="text" name="title" value="<?php echo $title; ?>">
		</div>
		
		<div class="form-detail clearFix">
			<div class="post_img l-float large-photo">
				<img src="<?php echo $img_src; ?>">
			</div>
				
			<div class="form-detail2 r-float">
				<table>
					<tr>
						<th width="200px"><p class="">投稿者名</p></th>
						<td><?php echo $u_name; ?></td>
					</tr>
		
					<tr>
						<th><p class="">投稿テーマ</p></th>
						<td>
							<select name="cate" class="box-line1">
								<?php foreach($cate as $val): 
									$cate_id = $val['CATE_ID'];
								?>
									<option value="<?php echo $cate_id; ?>" <?php if($cate_id === $p_cate){echo 'selected';} ?>><?php echo $val['CATE_NAME'];?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					
					<tr>
						<th><p class="">人数</p></th>
						<td><input class="box-line1"type="number" name="peaple" value="<?php echo $peaple; ?>"></td>
					</tr>
					
					<tr>
						<th><p class="">金額</p></th>
						<td><input class="box-line1" type="number" name="price" value="<?php echo $price; ?>"></td>
					</tr>
					
					<tr>
						<th><p class="">日数</p></th>
						<td><input class="box-line1" type="date" name="sday" value="<?php echo $sday; ?>">&nbsp～&nbsp<input class="box-line1"type="date" name="fday" value="<?php echo $fday; ?>"></td>
					</tr>
				</table>
			</div>  <!--post_detail2-->
			<div class="clearFix  align-center text-box">
				<p class="other-text ">記事全体コメント</p></th>
				<textarea class="box-line4" name="comment" cols="100" rows="10"><?php echo $p_comment; ?></textarea></td>
			</div>
		
		</div> <!--post_detail-->
					
			<input id="post_edit_btn" type="submit" value="確認画面へ">
		</form>
			
			<div id="checkins" class="box-frame shadow white align-center">
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
			</div> <!--checkins-->

		
		
	<div class="map" style="width:600px;height:600px;"></div>
		
	</div> <!--#wrap -->
</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>