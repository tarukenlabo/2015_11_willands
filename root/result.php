<?php
	session_start();

	require_once("./post.php");
	require_once('./get_cate.php');


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>result.php</title>
    <script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script src="./js/result.js"></script>
</head>
<body>

	<div>
		<h1>たるナビ</h1>

	</div>

	<div>

		<div>
<!--
検索条件
-->
			<div>
				<tr>
					<th>場所</th>
					<td>
					</td>
				</tr>
				<tr>
					<th>カテゴリ</th>
					<td>
						<?php
							$cate = array();
							$cate = get_cate();
						?>
						<select name="cate">
							<?php foreach($cate as $val): ?>
								<?php $cate_id = $val['CATE_ID']; ?>
								<option value="<?php echo $cate_id; ?>" ><?php echo $val['CATE_NAME'];?></option>
							<?php endforeach; ?>
						</select>
						<button id="search_by_cate">検索</button>
					</td>
				</tr>
				<tr>
					<th>キーワード</th>
					<td>
						<textarea name="keyword"></textarea>
						<button id="search_by_keword">検索</button>
					</td>
				</tr>

			</div>

		</div>
		
		<div>
<!--
写真一覧
-->
		<?php echo "写真一覧、最上段";?>


		<div class="result_list">
		</div>

		<?php echo "写真一覧、最下段";?>

		</div>

		<div>
<!--
地図指定
-->
		</div>
	
	</div>

</body>
</html>
