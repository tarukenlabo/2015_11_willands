
			<?php require 'header.php' ; ?>

			<nav>
				<ul>
					<li class="l-float clear-text box-3">
						<div class="orange">
							<p class="article-text">行き先が決まって無い方はこちら↓</p>
							<h3>旅行記の検索を始める♪</h3>
						</div>
					</li>
					<li class="l-float clear-text box-3">
						<div class="skyblue">
							<p class="article-text">旅行記を載せたい方はこちら↓</p>
							<h3>メンバーになって旅行記をアップ♪</h3>
						</div>
					</li>
					<li class="l-float clear-text box-3">
						<div class="limegreen">
							<p class="article-text">使い方を見たい方はこちら↓</p>
							<h3>ご利用ガイドを見る♪</h3>
						</div>
					</li>
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


	