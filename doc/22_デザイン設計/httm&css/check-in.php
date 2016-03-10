
			<?php require 'header.php' ; ?>

			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>
			
	<article class="clearFix white">
		<div class="map box-frame shadow"></div>
	
		<h1 class="contents-title">チェックイン</h1>
		<div class="box-frame shadow align_center">
		<form method="POST" action="checkin_upload.php" enctype="multipart/form-data">
		<p class="other-text">位置：</p>
		<p><input type="button" value="写真選択" onclick=""></p>
		<p class="other-text">コメント：<textarea name="comment"></textarea></p>
		<p><input type="submit" value="登録"><input type="reset" value="リセット"></p>
		</form>
		</div>
		
	</article>
			
			<?php require 'footer.php' ; ?>


	