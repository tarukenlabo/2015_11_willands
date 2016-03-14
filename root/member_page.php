<?php
	session_start();
	$u_id = $_SESSION['u_id'];

	require_once("./functions.php");
	require_once("./user.php");
	require_once("./post.php");

	$u_info = search_user_by_uid($_SESSION['u_id']);

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style_oocss_b.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<div id="wrap" class="">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
			<article class="hadairo clearFix">
				<!-- プロフィール画像 -->
				<div class="large-photo l-float white">
					<img src="<?php echo $u_info['U_THUMB']; ?>">
				</div>
				
				<div class="r-float align-r margin30">
					<h2 class="my-page"><?php echo $u_info['U_NAME'] ; ?>さんのマイページ</h2>
					<button type="button" onclick="location.href='./profile.php?u_id=<?php echo $u_info['U_ID']; ?>'" class="white box-line1"><a class="clear-text"><p class="other-title bold">プロフィールを編集</p></a></button><br>
					<button type="button" onclick="location.href='./favorite.php?u_id=<?php echo $u_info['U_ID']; ?>'" class="white box-line1"><a class="clear-text"><p class="other-title bold">お気に入りの記事へ</p></a></button>
				</div>
				
				<div class="align-center orange">
					<p class="contents-title">旅行記一覧</p>
					<button type="button" onclick="location.href='./trip-frame.php?u_id=<?php echo $u_id; ?>'"  class="box-line2 r-float"><a class=" clear-text"><p class="other-title bold">新しい旅行記を作成</p></a></button>

					<?php $stmt = search_u_id($_SESSION['u_id']); ?>
					<?php foreach($stmt as $post): ?>

					
					
					<div class="">
						<a href=<?php echo "./trip_form.php?p_id=" . $post['P_ID']; ?>>
						<div class="">
							<!-- 旅行のメイン画像 -->
							<img class="main_article_image" src="<?php echo $post['P_EYE']; ?>">
						</div>
					</div>


							
						<div class="margin10 l-float">
							<!-- 旅行の日程 -->
								<h3 class="other-text"><?php echo FormatPostDate($post['P_SDAY']) . "～" . FormatPostDate($post['P_FDAY']); ?></h3>
							<!-- 旅行のタイトル -->
								<h3 class="other-text"><?php echo $post['P_TITLE'] ?></h3>

							<p class="">公開ステータス</p>
							<p class="other-text">
								<?php if ($post['P_OFLAG'] == 0){
										echo "公開";
									} else {
										echo "非公開";
									}
								?>
							</p>
						</div>	

						<button type="button" onclick="location.href='./check-in.php?p_id=<?php echo $post['P_ID']; ?>'"  class="check-in l-float other-text shadow"><a class="">チェックイン</a></div>

				<?php endforeach;?>
				
				</div><!-- 投稿一覧ここまで -->			

			</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>