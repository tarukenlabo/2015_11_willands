<?php
	require_once('./get_cate.php');
	$cate = array();
	$cate = get_cate();
	
	session_start();
?>

<?php require 'header.php' ; ?>

	<body>
		<div id="wrap" class="align-center orange">


			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>




			
			<article class="clearFix align-center white">
				<h2 class="contents-title">新しい旅行記をつくる</h2>
				<div class="box-frame shadow">
	<form action="./trip_flame_post.php" method="post">
				<p class="other-text article-title">タイトル</p>
				<input class="box-line1" type="text" name="o_title" placeholder="タイトルを入力">
				<p class="other-text">カテゴリ</p>
					<select class="box-line1" name="cate">
						<?php foreach($cate as $val): ?>
							<option value="<?php echo $val['CATE_ID']; ?>"><?php echo $val['CATE_NAME'];?></option>
						<?php endforeach; ?>
					</select>
				<p class="other-text">出発日</p>
				<input class="box-line1" type="date" name="start_date">
				
				<p class="other-text">公開／下書き</p>
					<input type="radio" name="flag" value="0">公開
					<input type="radio" name="flag" value="1">下書き
		<input type="submit" value="作成">
	</form>
				</div>
				
			</article>
			
				<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>

	