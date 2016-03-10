<?php
	require_once('./get_cate.php');
	$cate = array();
	$cate = get_cate();
	
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
</head>
<body>
	<form action="./trip_flame_post.php" method="post">
		<table>
			<tr>
				<th>タイトル</th>
				<td><input type="text" name="o_title" placeholder="タイトルを入力"></td>
			</tr>
			<tr>
				<th>カテゴリ</th>
				<td>
					<select name="cate">
						<?php foreach($cate as $val): ?>
							<option value="<?php echo $val['CATE_ID']; ?>"><?php echo $val['CATE_NAME'];?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>出発日</th>
				<td><input type="date" name="start_date"></td>
			</tr>
			
			<tr>
				<th>公開／下書き</th>
				<td>
					<input type="radio" name="flag" value="0">公開
					<input type="radio" name="flag" value="1">下書き
				</td>
			</tr>
		</table>
		<input type="submit" value="作成">
	</form>
</body>
</html>