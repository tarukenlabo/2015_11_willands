<?php
	session_start();
	$u_id = $_SESSION['u_id'];

	require_once("./functions.php");
	require_once("./user.php");
	require_once("./post.php");

	date_default_timezone_set('Asia/Tokyo');


	$u_info = search_user_by_uid($_SESSION['u_id']);

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
			<article class="hadairo">
				<div class="large-photo l-float white"><img src="<?php echo $u_info['U_THUMB']; ?>"></div>
					<div class="r-float align-r margin30">
						<h2 class="my-page"><?php echo $u_info['U_NAME'] ; ?>さんのマイページ</h2>
						<button type="button" onclick="location.href=''"  class="white box-line1"><a class=" clear-text" href=<?php echo "./profile.php?u_id=" . $u_info['U_ID']; ?>><p class="other-title bold">プロフィールを編集</p></a></button><br>
						<button type="button" onclick="location.href=''"  class="white box-line1"><a class=" clear-text" href=<?php echo "./favorite.php?u_id=" . $u_info['U_ID']; ?>><p class="other-title bold">お気に入りの記事へ</p></a></button>
					</div>
				
				<div class="box-frame shadow align-center white clearFix">
					<p class="article-title l-float">旅行記一覧</p>
					<button type="button" onclick="location.href=''"  class="box-line1 r-float"><a class=" clear-text" href=<?php echo "./trip_flame.php?u_id=" . $u_id; ?>><p class="other-title bold">新しい旅行記を作成</p></a></button>

					<?php $stmt = search_u_id($_SESSION['u_id']); ?>
					<?php foreach($stmt as $post): ?>
					<div class="clearFix">
						<div class="trip-frame-box l-float shadow clearFix">
							<a href=<?php echo "./trip_form.php?p_id=" . $post['P_ID']; ?>>
							<div class="trip-frame-photo l-float">
								<img src="<?php echo $post['P_EYE']; ?>">
							</div>
							
							<div class="margin10 l-float">
								<h3 class="other-text"><?php echo FormatPostDate($post['P_SDAY']) . "～" . FormatPostDate($post['P_FDAY']); ?></h3>
								<h3 class="other-text"><?php echo $post['P_TITLE'] ?></h3>
							</div>
							<div class="r-float align-c margin10">
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
							</a>
						</div>
						<button type="button" onclick="location.href=''"  class="check-in l-float other-text shadow"><a class="clear-text" href=<?php echo "./check-in.php?p_id=".$post['P_ID']; ?>>チェックイン</a></div>
					</div>
					<?php endforeach;?>					
				
				</div>
			</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>