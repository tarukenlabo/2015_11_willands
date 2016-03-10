<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style_oocss.css" type="text/css">
		<link rel="stylesheet" href="./style.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

		
			<article class="clearFix align-center white">
				<h2 class="contents-title">よくある質問</h2>
				<div class="box-frame shadow">
	<form action="./trip_flame_post.php" method="post">
				<p class="article-title">タイトル</p>
				<input class="box-line1" type="text" name="o_title" placeholder="タイトルを入力">
				<p class="other-text">カテゴリ</p>
					<select  name="cate">
						<?php foreach($cate as $val): ?>
							<option value="<?php echo $val['CATE_ID']; ?>"><?php echo $val['CATE_NAME'];?></option>
						<?php endforeach; ?>
					</select>
				<p class="other-text">出発日</p>
				<input class="box-line1" type="date" name="start_date">
		<input type="submit" value="作成">
	</form>
				</div>
				
			</article>
			
				<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>

	