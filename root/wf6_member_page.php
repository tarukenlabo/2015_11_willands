<?php
    session_start();

	require_once("./user.php");
	require_once("./post.php");

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
			<h2><?php echo $u_info['U_NAME'] ; ?>さんのマイページ</h2>

		</div>

		<div>

			<h3><?php echo $u_info['U_NAME'] ; ?>さんの旅行一覧</h3>

			<?php
				$stmt = search_u_id($_SESSION['u_id']);
			?>
			<div>
				<?php foreach($stmt as $post): ?>
					<div>
					<p><?php echo $post['P_ID'] ?></p>
					<p><?php echo date('Y/m/d', strtotime($post['P_SDAY'])) . "～" . date('Y/m/d', strtotime($post['P_FDAY'])); ?></p>
					<p><?php echo $post['P_TITLE'] ?></p>
					<p><?php echo $post['P_OFLAG'] ?></p>				
					</div>
				<?php endforeach;?>
			</div>

		</div>

	</div>

</body>
</html>
