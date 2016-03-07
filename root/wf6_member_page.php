<?php
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
			<?php
				$u_info = search_uinfo_by_uid(1);
				echo $u_info['U_ID'] . " " . $u_info['U_NAME'];
			?>
		</div>

		<div>

			<h2><?php $u_info['U_NAME'] ; ?>さんの旅行一覧</h2>

			//新しい旅行を追加する

			//旅行一覧

			<?php
				$stmt = search_u_id(1);
			?>
			<div>
			<?php foreach($stmt as $post): ?>
				<div>
				<p><?php echo $post['P_ID'] ?></p>
				<p><?php echo date('Y/m/d', strtotime($post['P_SDAY'])) . "～" . date('Y/m/d', strtotime($post['P_FDAY'])); ?></p>
				<p><?php echo $post['P_TITLE'] ?></p>
				<p><?php echo $post['OFLAG'] ?></p>				
				</div>
			<?php endforeach;?>
			</div>

			<table>
				<caption>テスト入力</caption>
				<tr>
					<td>記事ID：（p_id）</td>

					//P_ID
					//日付
					//タイトル
					//写真
					//公開、非公開
					

				</tr>

		  </table>

		</div>

	</div>

</body>
</html>
