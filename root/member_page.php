<?php
	session_start();

	require_once("./user.php");
	require_once("./post.php");

	date_default_timezone_set('Asia/Tokyo')

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>マイページ</title>
</head>
<body>

	<div>
		<h1>たるナビ</h1>

	</div>
	<div>
		<div>
			<?php $u_info = search_user_by_uid($_SESSION['u_id']); ?>

			<h2>
				<img src=<?php echo $u_info['U_THUMB']; ?> alt=<?php echo $u_info['U_THUMB']; ?>>
				<?php echo $u_info['U_NAME'] ; ?>さんのマイページ
			</h2>
			<a href=<?php echo "./profile.php?u_id=" . $u_info['U_ID']; ?>>
				<p>プロフィールを編集</p>
			</a>
			<p>お気に入りのページへ</p>

		</div>

		<div>

			<h3><?php echo $u_info['U_NAME'] ; ?>さんの旅行一覧</h3>

			<a href=<?php echo "./trip_flame.php?u_id=" . $u_info['U_ID']; ?>>
			<p>新しい旅行記を作成</p>
			</a>

			<?php
				$stmt = search_u_id($_SESSION['u_id']);
			?>
			<div>
				<?php foreach($stmt as $post): ?>
				<div>
					<div>
						<a href=<?php echo "./trip_form.php?p_id=" . $post['P_ID']; ?>>
						<div>
						<p><img src=<?php echo $post['P_EYE']; ?> alt=<?php echo $post['P_EYE']; ?>></p>
						</div>
						<div>
							<p><?php echo date('Y/m/d', strtotime($post['P_SDAY'])) . "～" . date('Y/m/d', strtotime($post['P_FDAY'])); ?></p>
						</div>
						<div>
							<p><?php echo $post['P_TITLE'] ?></p>
						</div>
						</a>
						<div>
							<p><?php 
								if ($post['P_OFLAG'] = 1){
									echo "公開";
								} else {
									echo "非公開";
								}
							?></p>
						</div>
					</div>

					<div>
					<a href=<?php echo "./check-in.php?p_id=".$post['P_ID']; ?>>
					<p>ポイントチェック</p>
					</a>

				</div>
				<?php endforeach;?>
			</div>

		</div>

	</div>

</body>
</html>
